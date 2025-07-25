namespace Slack\Hack\JsonSchema\Codegen\Typing;

use namespace HH\Lib\{C, Keyset, Vec};

/**
 * Representation of the Hack type system exposing operations like union and intersection.
 *
 * Note that this class is final and abstract since it needs to be shared by all Codegen instances,
 * since Codegen instances may reference schemas generated by other Codegen instances.
 */
final abstract class TypeSystem {

  private static dict<string, Type> $aliases = dict[];

  /**
   * Build a reference to a type. The alias should already be registed with the type system.
   */
  public static function alias(string $alias): TypeAlias {
    return new TypeAlias($alias);
  }

  /**
   * Add a new alias to the type system.
   */
  public static function registerAlias(string $alias, Type $type): void {
    self::$aliases[$alias] = $type;
  }

  /**
   * Resolve a type alias to the type it references.
   */
  public static function resolveAlias(string $alias): ?Type {
    return self::$aliases[$alias] ?? null;
  }

  /**
   * Generate a boolean type.
   */
  public static function bool(): ConcreteType {
    return new ConcreteType(ConcreteTypeName::BOOL);
  }

  /**
   * Generate an integer type.
   */
  public static function int(): ConcreteType {
    return new ConcreteType(ConcreteTypeName::INT);
  }

  /**
   * Generate a keyset parameterized by an inner type.
   *
   * This type should be an arraykey, int or string, but we don't statically enforce that at the moment.
   */
  public static function keyset(Type $inner): ConcreteType {
    return new ConcreteType(ConcreteTypeName::KEYSET, vec[$inner]);
  }

  /**
   * Generate a mixed type. This is represented as an optional nonnull type.
   */
  public static function mixed(): OptionalType {
    return new OptionalType(self::nonnull());
  }

  /**
   * Generate a nonnull type (can be satisfied by any type which is not optional).
   */
  public static function nonnull(): ConcreteType {
    return new ConcreteType(ConcreteTypeName::NONNULL);
  }

  /**
   * Generate a null type. This is represented as an optional nothing type.
   */
  public static function null(): OptionalType {
    return new OptionalType(new ConcreteType(ConcreteTypeName::NOTHING));
  }

  /**
   * Generate a num type.
   */
  public static function num(): ConcreteType {
    return new ConcreteType(ConcreteTypeName::NUM);
  }

  public static function shape(Type::TShapeFields $fields, bool $is_closed_shape): ConcreteType {
    return new ConcreteType(ConcreteTypeName::SHAPE, vec[], $fields, $is_closed_shape);
  }

  /**
   * Generate a string type.
   */
  public static function string(): ConcreteType {
    return new ConcreteType(ConcreteTypeName::STRING);
  }

  /**
   * Generate the union of a list of types.
   *
   * For example, if the list contains int, string, and null, we'd generate ?arraykey, since
   * ?arraykey is the most broad type which is satisfied by either int, string, and null.
   */
  public static function union(
    vec<Type> $types,
    shape(?'disable_shape_unification' => bool) $options = shape()
  ): Type {
    $contains_null = C\any($types, $type ==> $type->isOptional());
    $type_names = Keyset\map($types, $type ==> $type->getConcreteTypeName());
    if ($options['disable_shape_unification'] ?? false) {
      $type_names = Keyset\map($type_names, $type_name ==> $type_name === ConcreteTypeName::SHAPE ? ConcreteTypeName::NONNULL : $type_name);
    }
    $builtin_type_name = self::getTypeHierarchy()->computeLowestUpperBound($type_names) ?? ConcreteTypeName::NOTHING;

    $generics = self::resolveGenerics($builtin_type_name, $types);

    list($shape_fields, $is_closed_shape) = self::resolveShapeFields($builtin_type_name, $types);

    $type = new ConcreteType($builtin_type_name, $generics, $shape_fields, $is_closed_shape);
    if ($contains_null) {
      $type = new OptionalType($type);
    }
    return self::maybeUseAlias($type, $types);
  }

  public static function vec(Type $inner): ConcreteType {
    return new ConcreteType(ConcreteTypeName::VEC, vec[$inner]);
  }

  /**
   * Build the type hierarchy used in Hacklang. While this is not as complex
   * as Hack's actual type hierarchy, it's a good approximation for our purposes.
   *
   * In the below DAG, each type is a vertex. Edges connect parents and children,
   * with an edge from A to B indicating that A is a parent of B.
   */
  <<__Memoize>>
  private static function getTypeHierarchy(): DAG<ConcreteTypeName> {
    return DAG::fromAdjacencyList(dict[
      ConcreteTypeName::ARRAYKEY => keyset[ConcreteTypeName::INT, ConcreteTypeName::STRING],
      ConcreteTypeName::BOOL => keyset[ConcreteTypeName::NOTHING],
      ConcreteTypeName::DICT => keyset[ConcreteTypeName::NOTHING],
      ConcreteTypeName::INT => keyset[ConcreteTypeName::NOTHING],
      ConcreteTypeName::KEYSET => keyset[ConcreteTypeName::NOTHING],
      ConcreteTypeName::NONNULL => keyset[
        ConcreteTypeName::ARRAYKEY,
        ConcreteTypeName::BOOL,
        ConcreteTypeName::DICT,
        ConcreteTypeName::KEYSET,
        ConcreteTypeName::NUM,
        ConcreteTypeName::SHAPE,
        ConcreteTypeName::VEC,
      ],
      ConcreteTypeName::NOTHING => keyset[],
      ConcreteTypeName::NUM => keyset[ConcreteTypeName::INT],
      ConcreteTypeName::SHAPE => keyset[ConcreteTypeName::NOTHING],
      ConcreteTypeName::STRING => keyset[ConcreteTypeName::NOTHING],
      ConcreteTypeName::VEC => keyset[ConcreteTypeName::NOTHING],
    ]);
  }

  /**
   * Try to map the solved type to one of the passed-in type aliases.
   *
   * If all types are the alias or null, use the alias.
   */
  private static function maybeUseAlias(Type $type, vec<Type> $types): Type {
    $equivalent_types = vec[];
    foreach ($types as $candidate_ty) {
      if ($type->isOptional() && !$candidate_ty->isOptional()) {
        // If the solved type T1 is optional but a candidate T2 isn't,
        // wrap the type T2 in an optional to see if we can return ?T2
        // instead of T1. This better preserves developer intent when
        // declaring the union of T2 and null, for example.
        $candidate_ty = new OptionalType($candidate_ty);
      }
      if ($candidate_ty->hasAlias() && $candidate_ty->isEquivalent($type)) {
        $equivalent_types[] = $candidate_ty;
      } else if ($candidate_ty->getConcreteTypeName() !== ConcreteTypeName::NOTHING) {
        // Conflicting type which is not null — bail out.
        return $type;
      }
    }

    // If there is exactly one unique alias A which is equivalent to the solved type T,
    // use the alias A instead of using the solved type T. This better matches developer
    // intent when combining aliases and other types: the union of A and a type T2
    // which is itself a subtype of A should be expressed as A.
    if (C\count(Vec\unique_by($equivalent_types, $ty ==> $ty->getName())) === 1) {
      return C\firstx($equivalent_types);
    } else {
      return $type;
    }
  }

  private static function resolveGenerics(ConcreteTypeName $builtin_type_name, vec<Type> $types): vec<Type> {
    $generics = vec[];
    // TODO: Handle dicts
    if ($builtin_type_name === ConcreteTypeName::VEC || $builtin_type_name === ConcreteTypeName::KEYSET) {
      $generics[] = Vec\map($types, $ty ==> C\first($ty->getGenerics()))
        |> Vec\filter_nulls($$)
        |> self::union($$);
    }
    return $generics;
  }

  private static function resolveShapeFields(ConcreteTypeName $builtin_type_name, vec<Type> $types): (Type::TShapeFields, bool) {
    // Union of shapes: union the shape fields such that `shape('a' => int) | shape('a' => string)`
    // becomes `shape('a' => arraykey)`. Assume any field absent from an open shape can only be
    // typed as `mixed`, so that `shape('a' => int) | shape('b' => int, ...)` becomes
    // `shape(?'b' => int, ...)`.
    $is_closed_shape = false;
    $shape_fields = dict[];

    if ($builtin_type_name === ConcreteTypeName::SHAPE) {
      // All types must be shapes or subtypes of shapes (i.e. nothing). In generating our unioned shape,
      // we only consider shapes, skipping nothing types.
      $num_shapes = 0;
      $num_closed_shapes = 0;
      $shape_field_types = dict[];
      $open_shape_field_counts = dict[];
      $required_field_counts = dict[];

      foreach ($types as $ty) {
        if ($ty->getConcreteTypeName() === ConcreteTypeName::SHAPE) {
          $num_shapes++;
          if ($ty->isClosedShape()) {
            $num_closed_shapes++;
          }

          foreach ($ty->getShapeFields() as $name => $field) {
            $shape_field_types[$name] ??= vec[];
            $shape_field_types[$name][] = $field['type'];

            if (!$ty->isClosedShape()) {
              $open_shape_field_counts[$name] ??= 0;
              $open_shape_field_counts[$name]++;
            }

            if ($field['required'] ?? false) {
              $required_field_counts[$name] ??= 0;
              $required_field_counts[$name]++;
            }
          }
        }
      }

      // A union of shapes containing at least one open shape cannot produce a closed shape.
      $num_open_shapes = $num_shapes - $num_closed_shapes;
      $is_closed_shape = $num_open_shapes === 0;
      foreach ($shape_field_types as $name => $field_types) {
        // If field is undefined in an open shape, it must be undefined in the union as well.
        if (($open_shape_field_counts[$name] ?? 0) === $num_open_shapes) {
          $unified_field_type = self::union($field_types);
          // A field is required if it's required by all shapes in the union.
          $required = ($required_field_counts[$name] ?? 0) === $num_shapes;

          if (
            $is_closed_shape ||
            $required ||
            // While we could skip non-required aliases which point to `mixed`, that seems
            // overly complicated.
            $unified_field_type->hasAlias() ||
            !$unified_field_type->isOptional() ||
            $unified_field_type->getConcreteTypeName() !== ConcreteTypeName::NONNULL
          ) {
            // Only add a field if it is not of the form ?'foo' => mixed.
            $shape_fields[$name] = shape('type' => $unified_field_type, 'required' => $required);
          }
        }
      }
    }

    return tuple($shape_fields, $is_closed_shape);
  }
}