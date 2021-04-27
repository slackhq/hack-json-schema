<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class NumberMinimumConstraint {
  public static function check(num $input, num $minimum, string $pointer): void {
    if ($input < $minimum) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MINIMUM,
          'expected' => $minimum,
          'got' => $input,
        ),
        'message' => "must be greater than {$minimum}",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);

    }
  }
}
