<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace HH\Lib\C;
use namespace Slack\Hack\JsonSchema;

class ObjectRequiredConstraint {
  public static function check(dict<string, mixed> $input, keyset<string> $required, string $pointer): void {
    $errors = vec[];
    foreach ($required as $name) {
      if (!C\contains_key($input, $name)) {
        $errors[] = shape(
          'code' => JsonSchema\FieldErrorCode::MISSING_FIELD,
          'message' => "missing required field: {$name}",
          'field' => $name,
        );
      }
    }

    if (C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }
  }
}
