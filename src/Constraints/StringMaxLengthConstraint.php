<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class StringMaxLengthConstraint {
  public static function check(int $length, int $maximum, string $pointer): void {
    if ($length > $maximum) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MAX_LENGTH,
          'expected' => $maximum,
          'got' => $length,
        ),
        'message' => 'must be less than '.($maximum + 1).' characters',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
