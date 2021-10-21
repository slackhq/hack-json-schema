<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use type Facebook\HackCodegen\{CodegenClass, CodegenFile, HackBuilder, HackCodegenFactory};

final class RootBuilder implements IBuilder {
  use Factory;

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

    $builder = $this->root->getBuilder();
    if ($builder is UniqueRefBuilder) {
      // This root points to a ref; e.g., the schema is '{"$ref": "./foo.json#"}'.
      // To honor the fact that this is the root, and therefore a class with its own name,
      // we still want to generate a validator. However, the validator will just
      // delegate to the referenced validator.
      $cg = $this->ctx->getHackCodegenFactory();
      $hb = new HackBuilder($cg->getConfig());
      $hb->addLinef(
        'return %s::check($input, $pointer);',
        $builder->getClassName()
      );
      $this->class->addMethod(
        $cg->codegenMethod('check')
          ->setPublic()
          ->setIsStatic(true)
          ->addParameters(vec['mixed $input', 'string $pointer'])
          ->setReturnType($this->getType())
          ->setBody($hb->getCode())
      );
      $this->file->addBeforeType(
        $cg->codegenType($this->getType())
          ->setType($builder->getType())
      );
    }

    return $this;
  }

  public function getClassName(): string {
    return $this->root->getClassName();
  }

  public function getType(): string {
    $builder = $this->root->getBuilder();
    if ($builder is UniqueRefBuilder) {
      // While we could use the builder's return type, tooling which expects the return type
      // to match e name of the generated validator would break. As such, generate a new
      // return type here.
      return $this->generateTypeName($this->ctx->getCodegenConfig()['validator']['class']);
    } else {
      return $this->root->getType();
    }
  }

  public function setSuffix(string $_suffix): void {
    // noop because we don't use suffixes for the root builder
  }

}
