<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use type Facebook\HackCodegen\{CodegenClass, CodegenFile, HackCodegenFactory};

final class RootBuilder implements IBuilder {
  private Context $ctx;
  private SchemaBuilder $root;

  public function __construct(
    private Codegen::TCodegenConfig $codegenConfig,
    private HackCodegenFactory $factory,
    private IJsonSchemaCodegenConfig $jsonSchemaCodegenConfig,
    private dict<arraykey, mixed> $schema,
    private CodegenClass $class,
    private CodegenFile $file,
  ) {
    $this->ctx = new Context($codegenConfig, $factory, $jsonSchemaCodegenConfig, $schema, $class->getName(), $file);

    $typed_schema = type_assert_shape($this->ctx->getSchema(), 'Slack\Hack\JsonSchema\Codegen\TSchema');
    $this->root = new SchemaBuilder($this->ctx, '', $typed_schema, $class);
  }

  public function build(): this {
    $this->root->build();
    return $this;
  }

  public function getClassName(): string {
    return $this->root->getClassName();
  }

  public function getClass(): CodegenClass {
    return $this->class;
  }

  public function getFile(): CodegenFile {
    return $this->file;
  }

  public function getType(): string {
    return $this->root->getType();
  }

  public function isArrayKeyType(): bool {
    return $this->root->isArrayKeyType();
  }

  public function setSuffix(string $_suffix): void {
    // noop because we don't use suffixes for the root builder
  }

}
