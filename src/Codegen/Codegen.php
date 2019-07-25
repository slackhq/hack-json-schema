<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\Vec;
use type Facebook\HackCodegen\{
  CodegenFile,
  CodegenGeneratedFrom,
  HackCodegenFactory,
  HackCodegenConfig,
  IHackCodegenConfig,
};

final class Codegen {

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

  private function __construct(
    private dict<arraykey, mixed> $schema,
    private self::TCodegenConfig $config,
  ) {}

  /**
  * Generate validators for multiple schema paths. This requires using unique
  * references and will auto generate class names and file names for the
  * validators. For more control over the output, use `forPath` or `forSchema`.
  */
  public static function forPaths(
    vec<string> $schema_paths,
    self::TCodegenConfigMulti $config,
  ): vec<Codegen> {
    $json_schema_codegen_config =
      $config['jsonSchemaCodegenConfig'] ?? new JsonSchemaCodegenConfig();

    $refs_config = $config['validator']['refs'];
    $unique_refs_config = $refs_config['unique'];

    // Generate configs for each validator. This calculates the class name and
    // the file name based on the unique refs config.

    $configs = Vec\map($schema_paths, ($schema_path) ==> {
      $names = UniqueRefBuilder::getNames(
        $json_schema_codegen_config,
        $unique_refs_config,
        $schema_path,
      );

      $schema_config = $config;

      $root_directory = $schema_config['validator']['refs']['root_directory'] ??
        \dirname($schema_path);
      $schema_config['validator']['refs']['root_directory'] = $root_directory;
      $schema_config['validator']['class'] = $names['class'];
      $schema_config['validator']['file'] = $names['file'];

      return $schema_config;
    });

    return Vec\map_with_key(
      $schema_paths,
      ($index, $path) ==> Codegen::forPath($path, $configs[$index]),
    );
  }

  public static function forPath(
    string $schema_path,
    self::TCodegenConfig $config,
  ): Codegen {
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
      $generated_from =
        $this->getHackCodegenFactory()->codegenGeneratedFromScript();
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
    return
      $this->config['jsonSchemaCodegenConfig'] ?? new JsonSchemaCodegenConfig();
  }

  public function build(): CodegenFile {
    return $this->buildValidator();
  }

  private function buildValidator(): CodegenFile {
    $config = $this->config['validator'];

    $builder = new ValidatorBuilder(
      $this->config,
      $this->getHackCodegenConfig(),
      $this->getJsonSchemaCodegenConfig(),
      $this->schema,
    );

    return $builder
      ->setCreateAbstractClass(false)
      ->setGeneratedFrom($this->getGeneratedFrom())
      ->setDiscardChanges($this->config['discardChanges'] ?? false)
      ->setSanitizeString($config['sanitize_string'] ?? null)
      ->renderToFile(
        $config['file'],
        $config['namespace'] ?? null,
        $config['class'],
      );
  }

}
