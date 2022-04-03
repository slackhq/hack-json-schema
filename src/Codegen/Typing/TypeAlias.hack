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
    return TypeSystem::resolveAlias($this->alias);
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
  public function hasAlias(): bool {
    return $this->getType()->hasAlias();
  }

  <<__Override>>
  public function isOptional(): bool {
    return $this->getType()->isOptional();
  }

  <<__Override>>
  public function render(): string {
    return $this->alias;
  }
}
