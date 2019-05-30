<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class StringPatternConstraint {
  public static function check(
    string $input,
    string $pattern,
    string $pointer,
  ): void {
    $match = \preg_match("/".$pattern."/", $input);
    if (!$match) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::PATTERN,
          'expected' => $pattern,
          'got' => $input,
        ),
        'message' => "input must match regex pattern: {$pattern}",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
