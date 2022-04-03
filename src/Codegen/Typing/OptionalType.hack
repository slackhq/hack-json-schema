namespace Slack\Hack\JsonSchema\Codegen\Typing;

/**
 * Represents an optional type in the Hack type system.
 *
 * In Hack, any concrete type can be made optional. When a type is optional,
 * it can be satisfied by `null`, which is the absence of a value. For example,
 * the type T can be made optional and is then written as ?T. The type `nonnull`,
 * when made optional, is written as `mixed`.
 */
final class OptionalType extends Type {
  public function __construct(private Type $type) {}

  <<__Override>>
  public function getConcreteTypeName(): ConcreteTypeName {
    return $this->type->getConcreteTypeName();
  }

  <<__Override>>
  public function getGenerics(): vec<Type> {
    return $this->type->getGenerics();
  }

  <<__Override>>
  public function hasAlias(): bool {
    return $this->type->hasAlias();
  }

  <<__Override>>
  public function isOptional(): bool {
    return true;
  }

  <<__Override>>
  public function render(): string {
    $type_name = $this->type->render();
    switch ($type_name) {
      case ConcreteTypeName::NOTHING:
        return 'null';
      case ConcreteTypeName::NONNULL:
        return 'mixed';
      default:
        return '?'.$type_name;
    }
  }
}
