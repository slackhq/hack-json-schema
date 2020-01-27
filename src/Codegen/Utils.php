<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\{Str, Vec};
use namespace Facebook\TypeAssert;

<<__Memoize>>
/* HH_IGNORE_ERROR[4030] `getResolvedTypeStructure` returns an `array` */
function _type_assert_get_type_structure(string $type) {
  $s = new \ReflectionTypeAlias($type);
  return $s->getResolvedTypeStructure();
}

function type_assert_shape<T>(mixed $var, string $shape): T {
  $ts = _type_assert_get_type_structure($shape);
  $result = TypeAssert\matches_type_structure($ts, $var);
  return $result;
}

function sanitize(string $input): string {
  return $input
    |> Str\replace($$, '_', ' ')
    |> Str\replace($$, '-', ' ')
    |> Str\replace($$, '.', ' ')
    |> \preg_replace("/[^A-Za-z0-9 ]/", '_nan_', $$)
    |> Str\capitalize_words($$)
    |> Str\replace($$, ' ', '');
}

function format(string ...$parts): string {
  return Vec\map($parts, fun('\Slack\Hack\JsonSchema\Codegen\sanitize'))
    |> Str\join($$, '');
}

/**
* Hacky "temporary" method that allows us to inspect codegen classes. We need
* to add getters to hack-codegen to allow us to do this introspection without
* reflection.
*/
function get_private_property(
  string $class_name,
  string $property_name,
  mixed $instance,
): mixed {
  $class = new \ReflectionClass($class_name);
  $property = $class->getProperty($property_name);
  $property->setAccessible(true);
  return $property->getValue($instance);
}
