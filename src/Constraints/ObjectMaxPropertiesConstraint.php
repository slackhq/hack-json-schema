<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class ObjectMaxPropertiesConstraint {
  public static function check(int $num_properties, int $max_properties, string $pointer): void {
    if ($num_properties > $max_properties) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MAX_PROPERTIES,
          'expected' => $max_properties,
          'got' => $num_properties,
        ),
        'message' => "no more than {$max_properties} properties allowed",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
