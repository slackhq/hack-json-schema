<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace HH\Lib\Str;
use namespace Slack\Hack\JsonSchema;

class StringMinLengthConstraint {
  public static function check(int $length, int $minimum, string $pointer): void {
    if ($minimum > $length) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MIN_LENGTH,
          'expected' => $minimum,
          'got' => $length,
        ),
        'message' => Str\format('must be greater than or equal to %s characters', (string)$minimum),
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
