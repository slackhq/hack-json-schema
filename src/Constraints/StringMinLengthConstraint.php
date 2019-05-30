<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class StringMinLengthConstraint {
  public static function check(
    int $length,
    int $minimum,
    string $pointer,
  ): void {
    if ($minimum > $length) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MIN_LENGTH,
          'expected' => $minimum,
          'got' => $length,
        ),
        'message' => "must be less than {$minimum} characters",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
