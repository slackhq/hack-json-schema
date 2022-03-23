<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\{Str, Vec};
use type Facebook\HackCodegen\{
  CodegenClass,
  CodegenFile,
  CodegenFileType,
  CodegenGeneratedFrom,
  CodegenMethod,
  HackBuilder,
  HackCodegenConfig,
  HackCodegenFactory,
  IHackCodegenConfig,
};

final class Codegen implements IBuilder {

  const type TValidatorRefsUniqueConfig = shape(
    /* The root path where all of the schemas live */
    'source_root' => string,
    /* The root path where the generated classes will be output */
    'output_root' => string,
  );

  const type TValidatorRefsConfig = shape(
    /* The root directory to resolve references to */
    ?'root_directory' => string,
    /* Config for unique references */
    ?'unique' => self::TValidatorRefsUniqueConfig,
  );

  const type TValidatorDefaultsConfig = shape(
    /* Default for `coerce` */
    ?'coerce' => bool,
  );

  const type TValidatorConfig = shape(
    /* The namespace that gets added to each file */
    ?'namespace' => string,
    /* Config for how to sanitize strings */
    ?'sanitize_string' => self::TSanitizeStringConfig,
    /* The class name to use for the generated validator */
    'class' => string,
    /* The file to write the generated validator to */
    'file' => string,
    /* Config for resolving references */
    ?'refs' => self::TValidatorRefsConfig,
    /* Config for various default values */
    ?'defaults' => self::TValidatorDefaultsConfig,
    /*
     * Config for passing values through to the `Context` class that will get
     * instatiated when generating code
     */
    ?'context' => shape(
      ?'root_schema' => TSchema,
      ?'root_schema_path' => string,
    ),
    ?'discard_additional_properties' => bool,
  );

  const type TSanitizeStringConfig = shape(
    /* Sanitization function for single line strings */
    'uniline' => (function(string): string),
    /* Sanitization function for multiline strings */
    'multiline' => (function(string): string),
  );

  const type TCodegenConfig = shape(
    ?'hackCodegenConfig' => IHackCodegenConfig,
    ?'jsonSchemaCodegenConfig' => IJsonSchemaCodegenConfig,
    ?'generatedFrom' => string,
    'validator' => self::TValidatorConfig,
    ?'discardChanges' => bool,
  );

  // When using `forPaths` some config keys are optional or required. The ones
  // listed below with the `Multi` suffix are derivatives of the above with
  // slight modifications to support auto-generating class names and file paths.
  const type TCodegenConfigMulti = shape(
    ?'hackCodegenConfig' => IHackCodegenConfig,
    ?'jsonSchemaCodegenConfig' => IJsonSchemaCodegenConfig,
    ?'generatedFrom' => string,
    'validator' => self::TValidatorConfigMulti,
    ?'discardChanges' => bool,
  );

  const type TValidatorRefsConfigMulti = shape(
    /* The root directory to resolve references to */
    ?'root_directory' => string,
    /* Config for unique references */
    'unique' => self::TValidatorRefsUniqueConfig,
  );

  const type TValidatorConfigMulti = shape(
    /* The namespace that gets added to each file */
    ?'namespace' => string,
    /* Config for how to sanitize strings */
    ?'sanitize_string' => self::TSanitizeStringConfig,
    /* Config for resolving references */
    'refs' => self::TValidatorRefsConfigMulti,
    /* Config for various default values */
    ?'defaults' => self::TValidatorDefaultsConfig,
    /*
     * Config for passing values through to the `Context` class that will get
     * instatiated when generating code
     */
    ?'context' => shape(
      ?'root_schema' => TSchema,
      ?'root_schema_path' => string,
    ),
  );

  private ?CodegenGeneratedFrom $generatedFrom;
  private HackCodegenFactory $cg;
  private bool $discardChanges = false;
  private bool $createAbstract = false;
  private SchemaBuilder $builder;
  private CodegenClass $class;
  private CodegenFile $file;
  private ?Codegen::TSanitizeStringConfig $sanitizeString = null;

  private function __construct(private dict<arraykey, mixed> $schema, private self::TCodegenConfig $config) {
    $this->cg = new HackCodegenFactory($this->getHackCodegenConfig());

    $validatorConfig = $config['validator'];

    $this->class = $this->cg->codegenClass($validatorConfig['class']);

    $this->file = $this->cg
      ->codegenFile($validatorConfig['file'])
      ->setFileType(CodegenFileType::HACK_STRICT)
      ->setGeneratedFrom($this->getGeneratedFrom())
      ->setDoClobber($config['discardChanges'] ?? false)
      ->useNamespace('Slack\Hack\JsonSchema');

    if (Shapes::keyExists($validatorConfig, 'namespace')) {
      $this->file->setNamespace($validatorConfig['namespace']);
    }

    $context = new Context(
      $this->config,
      $this->cg,
      $this->getJsonSchemaCodegenConfig(),
      $this->schema,
      $this->class->getName(),
      $this->file
    );
    $typed_schema = type_assert_type($this->schema, TSchema::class);
    $this->builder = new SchemaBuilder($context, '', $typed_schema, $this->class);

    $this->sanitizeString = $validatorConfig['sanitize_string'] ?? null;
  }

  /**
  * Generate validators for multiple schema paths. This requires using unique
  * references and will auto generate class names and file names for the
  * validators. For more control over the output, use `forPath` or `forSchema`.
  */
  public static function forPaths(vec<string> $schema_paths, self::TCodegenConfigMulti $config): vec<Codegen> {
    $json_schema_codegen_config = $config['jsonSchemaCodegenConfig'] ?? new JsonSchemaCodegenConfig();

    $refs_config = $config['validator']['refs'];
    $unique_refs_config = $refs_config['unique'];

    // Generate configs for each validator. This calculates the class name and
    // the file name based on the unique refs config.

    $configs = Vec\map($schema_paths, ($schema_path) ==> {
      $names = UniqueRefBuilder::getNames($json_schema_codegen_config, $unique_refs_config, $schema_path);

      $schema_config = $config;

      $root_directory = $schema_config['validator']['refs']['root_directory'] ?? \dirname($schema_path);
      $schema_config['validator']['refs']['root_directory'] = $root_directory;
      $schema_config['validator']['class'] = $names['class'];
      $schema_config['validator']['file'] = $names['file'];

      return $schema_config;
    });

    return Vec\map_with_key($schema_paths, ($index, $path) ==> Codegen::forPath($path, $configs[$index]));
  }

  public static function forPath(string $schema_path, self::TCodegenConfig $config): Codegen {
    $contents = \file_get_contents($schema_path);
    if (!$contents) {
      throw new \Exception("Failed reading schema: `{$schema_path}`");
    }

    $schema = \json_decode(
      $contents,
      true, /* default stack_depth */
      512,
      \JSON_FB_HACK_ARRAYS,
    );
    if ($schema === null) {
      throw new \Exception("Failed decoding schema: `{$schema_path}`");
    }

    $refs = $config['validator']['refs'] ?? shape();
    $refs['root_directory'] = \dirname($schema_path);
    $config['validator']['refs'] = $refs;

    $context_config = $config['validator']['context'] ?? null;
    if ($context_config === null) {
      $context_config = shape();
    }

    $context_config['root_schema_path'] = $schema_path;
    $context_config['root_schema'] = $schema;
    $config['validator']['context'] = $context_config;
    return new self($schema, $config);
  }

  public static function forSchema(
    dict<arraykey, mixed> $schema,
    self::TCodegenConfig $config,
    string $refs_root_directory,
  ): Codegen {
    $refs = $config['validator']['refs'] ?? shape();
    $refs['root_directory'] = $refs_root_directory;
    $config['validator']['refs'] = $refs;

    return new self($schema, $config);
  }

  <<__Memoize>>
  private function getGeneratedFrom(): CodegenGeneratedFrom {
    $generated_from = $this->config['generatedFrom'] ?? null;
    if ($generated_from is nonnull) {
      $generated_from = $this->getHackCodegenFactory()
        ->codegenGeneratedFromScript($generated_from);
    } else {
      $generated_from = $this->getHackCodegenFactory()->codegenGeneratedFromScript();
    }

    return $generated_from;
  }

  <<__Memoize>>
  private function getHackCodegenFactory(): HackCodegenFactory {
    return new HackCodegenFactory($this->getHackCodegenConfig());
  }

  <<__Memoize>>
  private function getHackCodegenConfig(): IHackCodegenConfig {
    return $this->config['hackCodegenConfig'] ?? new HackCodegenConfig();
  }

  <<__Memoize>>
  private function getJsonSchemaCodegenConfig(): IJsonSchemaCodegenConfig {
    return $this->config['jsonSchemaCodegenConfig'] ?? new JsonSchemaCodegenConfig();
  }

  public function build(): this {
    $this->builder->build();

    if ($this->builder->isUniqueRef()) {
      // No need to do anything, we're building a top-level ref.
      return $this;
    }

    $this->class = $this->class
      ->setExtends("JsonSchema\BaseValidator<{$this->builder->getType()}>")
      ->setIsAbstract(false)
      ->setIsFinal(true)
      ->addMethod($this->getCodegenClassProcessMethod());

    $this->file->addClass($this->class);

    $contents = $this->file->render();
    if (Str\contains($contents, 'Constraints\\')) {
      $this->file->useNamespace('Slack\Hack\JsonSchema\Constraints');
    }

    $this->file->save();

    return $this;
  }

  private function getCodegenClassProcessMethod(): CodegenMethod {
    $hb = new HackBuilder($this->getHackCodegenConfig());
    $hb->addMultilineCall('return self::check', vec['$this->input', '$this->pointer']);

    return $this->cg
      ->codegenMethod('process')
      ->setReturnType($this->builder->getType())
      ->addEmptyUserAttribute('__Override')
      ->setProtected()
      ->setBody($hb->getCode());
  }

  public function getClass(): CodegenClass {
    return $this->class;
  }

  public function getFile(): CodegenFile {
    return $this->file;
  }

  public function getClassName(): string {
    return $this->builder->getClassName();
  }

  public function getType(): string {
    return $this->builder->getType();
  }

  public function isArrayKeyType(): bool {
    return $this->builder->isArrayKeyType();
  }

  public function setSuffix(string $_suffix): void {
  }
}
