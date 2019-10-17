<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\{C, Str};

use type Facebook\HackCodegen\{CodegenFile, HackCodegenFactory};

final class Context {
  private Codegen::TValidatorConfig $validatorConfig;
  private TSchema $schema;
  private ?Codegen::TValidatorRefsConfig $refsConfig;
  private ?TSchema $rootSchema;
  private ?string $currentRefFileName;

  public function __construct(
    private Codegen::TCodegenConfig $codegenConfig,
    private HackCodegenFactory $factory,
    private IJsonSchemaCodegenConfig $jsonSchemaCodegenConfig,
    dict<arraykey, mixed> $schema_dict,
    private string $classname,
    private CodegenFile $file,
    private keyset<string> $seen_refs = keyset[],
  ) {
    $this->validatorConfig = $codegenConfig['validator'];
    $this->refsConfig = $this->validatorConfig['refs'] ?? null;
    $this->schema =
      type_assert_shape($schema_dict, '\Slack\Hack\JsonSchema\Codegen\TSchema');

    $context_config = $this->validatorConfig['context'] ?? null;
    if ($context_config is nonnull) {
      $root_schema = $context_config['root_schema'] ?? null;
      if ($root_schema is nonnull) {
        $this->rootSchema = type_assert_shape(
          $root_schema,
          'Slack\Hack\JsonSchema\Codegen\TSchema',
        );
      }

      $root_schema_path = $context_config['root_schema_path'] ?? null;
      if ($root_schema_path is nonnull) {
        $relative_path = Str\split($root_schema_path, '/') |> C\last($$) ?? '';
        $this->setCurrentRefFileName($relative_path);
      }
    }
  }

  public function getCoerceDefault(): bool {
    $defaults = $this->validatorConfig['defaults'] ?? shape();
    return $defaults['coerce'] ?? false;
  }

  public function getHackCodegenFactory(): HackCodegenFactory {
    return $this->factory;
  }

  public function getSchema(): TSchema {
    return $this->schema;
  }

  public function setSchema(TSchema $schema): void {
    $this->schema = $schema;
  }

  public function getClassName(): string {
    return $this->classname;
  }

  public function getFile(): CodegenFile {
    return $this->file;
  }

  public function setRootSchema(TSchema $schema): void {
    $this->rootSchema = $schema;
  }

  public function setRefsRootDirectory(string $path): void {
    $refs_config = $this->refsConfig;
    if ($refs_config === null) {
      $refs_config = shape();
    }

    $refs_config['root_directory'] = $path;
    $this->refsConfig = $refs_config;
  }

  public function getRefsRootDirectory(): ?string {
    $refs_config = $this->refsConfig ?? null;
    if ($refs_config === null) {
      return null;
    }

    return $refs_config['root_directory'] ?? null;
  }

  public function getUniqueRefsConfig(): ?Codegen::TValidatorRefsUniqueConfig {
    $config = null;
    $refs_config = $this->refsConfig ?? null;
    if ($refs_config is nonnull) {
      $config = $refs_config['unique'] ?? null;
    }

    return $config;
  }

  public function getCodegenConfig(): Codegen::TCodegenConfig {
    return $this->codegenConfig;
  }

  public function getSanitizeStringConfig(): ?Codegen::TSanitizeStringConfig {
    return $this->validatorConfig['sanitize_string'] ?? null;
  }

  public function setCurrentRefFileName(string $fp): void {
    $this->currentRefFileName = $fp;
  }

  public function getCurrentRefFileName(): ?string {
    return $this->currentRefFileName;
  }

  public function getJsonSchemaCodegenConfig(): IJsonSchemaCodegenConfig {
    return $this->jsonSchemaCodegenConfig;
  }

  public function getRootSchema(): ?TSchema {
    return $this->rootSchema;
  }

  public function acknowledgeRef(string $ref): void {
    $this->seen_refs[] = $ref;
  }

  public function hasSeenRef(string $ref): bool {
    return C\contains($this->seen_refs, $ref);
  }
}
