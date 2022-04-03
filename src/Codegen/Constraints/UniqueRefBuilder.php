<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\Str;

use type Facebook\HackCodegen\CodegenMethod;

type TCodegenMethods = vec<CodegenMethod>;

class UniqueRefBuilder implements IBuilder {
  use RefResolver;

  private string $classname;
  private string $filename;
  private ?RefCache::TCachedRef $cached_ref;

  public function __construct(protected Context $ctx, protected string $ref, protected TSchema $schema) {
    $this->classname = '';
    $this->filename = '';

    $refs_root = $this->ctx->getRefsRootDirectory() ?? '';
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

    if (RefCache::isRefCached($this->filename)) {
      $this->cached_ref = RefCache::getCachedRef($this->filename);
    } else {
      $codegen = Codegen::forSchema(Shapes::toDict($this->schema), $codegen_config, $root_directory);
      $codegen->build();
      $this->cached_ref = shape(
        'type' => $codegen->getType(),
        'classname' => $codegen->getClassName(),
        'isArrayKeyType' => $codegen->isArrayKeyType(),
      );
      RefCache::cacheRef($this->filename, $this->cached_ref);
    }

    return $this;
  }

  public function getClassName(): string {
    return $this->classname;
  }

  public function getType(): string {
    invariant($this->cached_ref is nonnull, 'must call `build` method before accessing type');
    return $this->cached_ref['type'];
  }

  public function isArrayKeyType(): bool {
    invariant($this->cached_ref is nonnull, 'must call `build` method before accessing type');
    return $this->cached_ref['isArrayKeyType'];
  }

  public function setSuffix(string $_suffix): void {
    // noop because we don't use suffixes for unique refs
  }

  public function getTypeInfo(): Typing\Type {
    return Typing\TypeSystem::alias($this->getType());
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
