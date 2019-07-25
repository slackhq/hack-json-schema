<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use type Facebook\HackCodegen\{
  CodegenClass,
  CodegenProperty,
  CodegenMethod,
  HackBuilder,
  HackBuilderValues,
};

<<__ConsistentConstruct>>
abstract class BaseBuilder<T> implements IBuilder {
  use Factory;

  protected T $typed_schema;
  protected static string $schema_name = '';

  public function __construct(
    protected Context $ctx,
    protected string $suffix,
    protected TSchema $schema,
    protected ?CodegenClass $class = null,
  ) {
    $this->typed_schema =
      type_assert_shape($this->schema, static::$schema_name);
  }

  /**
  *
  * Return a string which will get rendered as a literal value describing the
  * output type of the schema. For example, the `StringBuilder` would return:
  * `return 'string';`, the `NumberBuilder` would return: `return 'num';`.
  */
  abstract public function getType(): string;

  /**
  *
  * Main method for building the class for the schema and appending it to the
  * file.
  */
  abstract public function build(): this;

  protected function getHackBuilder(): HackBuilder {
    return new HackBuilder($this->ctx->getHackCodegenFactory()->getConfig());
  }

  public function getClassName(): string {
    return $this->generateClassName($this->ctx->getClassName(), $this->suffix);
  }

  protected function codegenClass(): CodegenClass {
    if ($this->class) {
      return $this->class;
    }

    return $this->ctx
      ->getHackCodegenFactory()
      ->codegenClass($this->getClassName())
      ->setIsFinal(true);
  }

  protected function codegenProperty(string $name): CodegenProperty {
    return $this->ctx
      ->getHackCodegenFactory()
      ->codegenProperty($name)
      ->setIsStatic(true)
      ->setPrivate();
  }

  protected function codegenCheckMethod(): CodegenMethod {
    return $this->ctx
      ->getHackCodegenFactory()
      ->codegenMethod('check')
      ->setPublic()
      ->setIsStatic(true);
  }

  protected function getEnumCodegenProperty(): ?CodegenProperty {
    $property = null;
    $schema = type_assert_shape(
      $this->typed_schema,
      'Slack\Hack\JsonSchema\Codegen\TSchema',
    );
    $enum = $schema['enum'] ?? null;
    if ($enum is nonnull) {
      $hb = $this->getHackBuilder()
        ->addValue($enum, HackBuilderValues::vec(HackBuilderValues::export()));

      $property = $this->codegenProperty('enum')
        ->setType('vec<mixed>')
        ->setValue($hb->getCode(), HackBuilderValues::literal());
    }
    return $property;
  }

  protected function addEnumConstraintCheck(HackBuilder $hb): void {
    $schema = type_assert_shape(
      $this->typed_schema,
      'Slack\Hack\JsonSchema\Codegen\TSchema',
    );
    if (($schema['enum'] ?? null) is nonnull) {
      $hb->addMultilineCall(
        'Constraints\EnumConstraint::check',
        ['$typed', 'self::$enum', '$pointer'],
      );
    }
  }

  public function addBuilderClass(CodegenClass $class): void {
    if ($this->class) {
      return;
    }

    $this->ctx->getFile()->addClass($class);
  }

  public function setSuffix(string $suffix): void {
    $this->suffix = $suffix;
  }
}
