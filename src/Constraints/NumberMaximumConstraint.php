<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class NumberMaximumConstraint {
  public static function check(
    num $input,
    num $maximum,
    string $pointer,
  ): void {
    if ($input > $maximum) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MAXIMUM,
          'expected' => $maximum,
          'got' => $input,
        ),
        'message' => "must be less than {$maximum}",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
