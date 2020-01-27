<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace HH\Lib\C;
use namespace Slack\Hack\JsonSchema;

class EnumConstraint {
  public static function check(
    mixed $input,
    vec<mixed> $enum,
    string $pointer,
  ): void {
    if (!C\contains($enum, $input)) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ENUM,
          'expected' => $enum,
          'got' => $input,
        ),
        'message' => "must be a valid enum value",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
