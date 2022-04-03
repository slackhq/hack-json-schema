namespace Slack\Hack\JsonSchema\Codegen\Typing;

use namespace HH\Lib\{C, Vec};

/**
 * A type in the type system. Can be a concrete type, an optional type
 * (which wraps a concrete type or an alias, for example converting "nothing"
 * to "null"), or an alias (which may wrap either an optional or concrete type).
 */
abstract class Type {

  /**
   * The builtin underlying this type.
   */
  abstract public function getConcreteTypeName(): ConcreteTypeName;

  /**
   * Any generics wrapped by this type.
   */
  abstract public function getGenerics(): vec<Type>;

  /**
   * Whether this type has an alias (e.g., is of form <alias> or ?<alias>).
   */
  abstract public function hasAlias(): bool;

  /**
   * Whether this type is optional (i.e., null can be substituted).
   */
  abstract public function isOptional(): bool;

  /**
   * Render this type to a string.
   */
  abstract public function render(): string;

  /**
   * True IFF two types can be substituted for one another.
   */
  final public function isEquivalent(Type $type): bool {
    // TODO: Handle generics and shapes.
    if ($this->isOptional() !== $type->isOptional()) {
      return false;
    }
    if ($this->getConcreteTypeName() !== $type->getConcreteTypeName()) {
      return false;
    }
    $this_generics = $this->getGenerics();
    $that_generics = $type->getGenerics();
    if (C\count($this_generics) !== C\count($that_generics)) {
      return false;
    }
    foreach (Vec\zip($this_generics, $that_generics) as list($a, $b)) {
      if (!$a->isEquivalent($b)) {
        return false;
      }
    }
    return true;
  }
}
