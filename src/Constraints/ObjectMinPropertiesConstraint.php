<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class ObjectMinPropertiesConstraint {
  public static function check(int $num_properties, int $min_properties, string $pointer): void {
    if ($num_properties < $min_properties) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MIN_PROPERTIES,
          'expected' => $min_properties,
          'got' => $num_properties,
        ),
        'message' => "must have minimum {$min_properties} properties",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
