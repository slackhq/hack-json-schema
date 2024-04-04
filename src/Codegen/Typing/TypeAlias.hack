namespace Slack\Hack\JsonSchema\Codegen\Typing;

/**
 * An alias referencing another type in the type system.
 *
 * The referenced type may be an alias, an optional type,
 * or a concrete type.
 */
final class TypeAlias extends Type {
  public function __construct(private string $alias) {}

  private function getType(): Type {
    return TypeSystem::resolveAlias($this->alias) as nonnull;
  }

  <<__Override>>
  public function getConcreteTypeName(): ConcreteTypeName {
    return $this->getType()->getConcreteTypeName();
  }

  <<__Override>>
  public function getGenerics(): vec<Type> {
    return $this->getType()->getGenerics();
  }

  <<__Override>>
  public function getName(): string {
    return $this->alias;
  }

  <<__Override>>
  public function getShapeFields(): this::TShapeFields {
    return $this->getType()->getShapeFields();
  }

  <<__Override>>
  public function hasAlias(): bool {
    return true;
  }

  <<__Override>>
  public function isClosedShape(): bool {
    return $this->getType()->isClosedShape();
  }

  <<__Override>>
  public function isOptional(): bool {
    return $this->getType()->isOptional();
  }
}
