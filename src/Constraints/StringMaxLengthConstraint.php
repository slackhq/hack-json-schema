<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace HH\Lib\Str;
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
        'message' => Str\format('must be less than or equal to %s characters', (string)$maximum),
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
