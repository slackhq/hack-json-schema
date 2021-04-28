<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\{Str, Vec};

use type Facebook\HackCodegen\CodegenMethod;

type TCodegenMethods = vec<CodegenMethod>;

class UniqueRefBuilder implements IBuilder {
  use RefResolver;

  private string $classname;
  private string $filename;
  private ?string $type;

  public function __construct(protected Context $ctx, protected string $ref, protected TSchema $schema) {
    $this->classname = '';
    $this->filename = '';

    $refs_root = $this->ctx->getRefsRootDirectory();
    $ref_file_path = $this->ctx->getCurrentRefFileName();
    if (Str\is_empty($ref_file_path)) {
      $ref_file_path = $this->getRefFilePath($this->ref);
    }
    $ref_file_path as nonnull;

    $resolved_path = \realpath($refs_root.'/'.$ref_file_path);
    $unique_refs_config = $this->ctx->getUniqueRefsConfig();
    $unique_refs_config as nonnull;

    $source_root = $unique_refs_config['source_root'];
    if (!Str\contains($resolved_path, $source_root)) {
      throw new \Exception("Provided `source_root` ($source_root) not found in the resolved ref path ($resolved_path)");
    }

    $schema_path = $this->getRefSchemaPath($this->ref);
    $names = static::getNames($ctx->getJsonSchemaCodegenConfig(), $unique_refs_config, $resolved_path, $schema_path);

    $this->classname = $names['class'];
    $this->filename = $names['file'];
  }

  public function build(): this {
    $codegen_config = $this->ctx->getCodegenConfig();
    $root_directory = $this->ctx->getRefsRootDirectory() as nonnull;

    $refs_config = $codegen_config['validator']['refs'] ?? shape();
    $refs_config['root_directory'] = $root_directory;

    $context_config = shape(
      'root_schema' => $this->ctx->getSchema(),
    );
    $root_schema_path = $this->ctx->getCurrentRefFileName();
    if ($root_schema_path is nonnull) {
      $context_config['root_schema_path'] = $root_schema_path;
    }

    $codegen_config['validator']['class'] = $this->classname;
    $codegen_config['validator']['file'] = $this->filename;
    $codegen_config['validator']['refs'] = $refs_config;
    $codegen_config['validator']['context'] = $context_config;

    $codegen = Codegen::forSchema(Shapes::toDict($this->schema), $codegen_config, $root_directory);

    $codegen_file = null;
    if (RefCache::isRefCached($this->filename)) {
      $codegen_file = RefCache::getCachedFile($this->filename);
    } else {
      $codegen_file = $codegen->build();
    }

    RefCache::cacheRef($this->filename, $codegen_file);

    $main_class = Vec\filter($codegen_file->getClasses(), $class ==> $class->getName() === $this->classname)[0];

    $methods = get_private_property(\get_class($main_class), 'methods', $main_class)
      |> type_assert_shape($$, '\Slack\Hack\JsonSchema\Codegen\TCodegenMethods');

    $check_method = Vec\filter(
      $methods,
      $method ==> {
        $name = get_private_property(\get_class($method), 'name', $method);
        return $name === 'check';
      },
    )[0];

    $return_type = get_private_property(\get_class($check_method), 'returnType', $check_method);
    $this->type = $return_type as string;

    return $this;
  }

  public function getClassName(): string {
    return $this->classname;
  }

  public function getType(): string {
    invariant($this->type is nonnull, 'must call `build` method before accessing type');
    return $this->type;
  }

  public function setSuffix(string $_suffix): void {
    // noop because we don't use suffixes for unique refs
  }

  /**
  * Static function for generating class and file names based off the unique
  * ref config. This is static because we use it in `Codegen::forPaths`
  */
  public static function getNames(
    IJsonSchemaCodegenConfig $json_schema_codegen_config,
    Codegen::TValidatorRefsUniqueConfig $unique_refs_config,
    string $file_path,
    string $schema_path = '',
  ): shape(
    'class' => string,
    'file' => string,
  ) {
    $classname_formatter = $json_schema_codegen_config->getClassNameFormatFunction();
    $filename_formatter = $json_schema_codegen_config->getFileNameFormatFunction();

    $relative_path = Str\strip_prefix($file_path, $unique_refs_config['source_root'].'/');
    $path_pointers = Str\strip_suffix($relative_path, '.json')
      |> Str\split($$, '/')
      |> Str\join($$, '_');
    $schema_pointers = Str\split($schema_path, '/') |> Str\join($$, '_');

    $classname = $classname_formatter($path_pointers, $schema_pointers);
    $filename = $unique_refs_config['output_root'].'/'.$filename_formatter($classname).'.php';

    return shape(
      'class' => $classname,
      'file' => $filename,
    );
  }

}
