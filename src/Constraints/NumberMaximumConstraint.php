<?hh // strict

use namespace HH\Lib\Str;
namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class NumberMaximumConstraint {
  public static function check(num $input, num $maximum, string $pointer): void {
    if ($input > $maximum) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MAXIMUM,
          'expected' => $maximum,
          'got' => $input,
        ),
        'message' => Str\format('must be less than %s', (string)$maximum),
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
