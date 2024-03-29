namespace Slack\Hack\JsonSchema\Codegen\Typing;

use namespace HH\Lib\{C, Vec};

/**
 * A type in the type system. Can be a concrete type, an optional type
 * (which wraps a concrete type or an alias, for example converting "nothing"
 * to "null"), or an alias (which may wrap either an optional or concrete type).
 */
abstract class Type {
  const type TShapeFields = dict<string, shape(?'required' => bool, 'type' => Type)>;

  /**
   * The builtin underlying this type.
   */
  abstract public function getConcreteTypeName(): ConcreteTypeName;

  /**
   * Any generics wrapped by this type.
   */
  abstract public function getGenerics(): vec<Type>;

  /**
   * Get the name of this type.
   */
  abstract public function getName(): string;

  /**
   * Get the shape fields present in this type, if any.
   */
  abstract public function getShapeFields(): this::TShapeFields;

  /**
   * Whether this type has an alias (e.g., is of form <alias> or ?<alias>).
   */
  abstract public function hasAlias(): bool;

  /**
   * Whether this type is a closed shape.
   */
  abstract public function isClosedShape(): bool;

  /**
   * Whether this type is optional (i.e., null can be substituted).
   */
  abstract public function isOptional(): bool;

  /**
   * True IFF two types can be substituted for one another.
   */
  final public function isEquivalent(Type $type): bool {
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
    $this_shape_fields = $this->getShapeFields();
    $that_shape_fields = $type->getShapeFields();
    if (C\count($this_shape_fields) !== C\count($that_shape_fields)) {
      return false;
    }
    foreach ($this_shape_fields as $name => $this_shape_field) {
      $that_shape_field = $that_shape_fields[$name] ?? null;
      if (
        $that_shape_field is null ||
        Shapes::idx($this_shape_field, 'required', false) !== Shapes::idx($that_shape_field, 'required', false) ||
        !$this_shape_field['type']->isEquivalent($that_shape_field['type'])
      ) {
        return false;
      }
    }
    if ($this->isClosedShape() !== $type->isClosedShape()) {
      return false;
    }
    return true;
  }
}