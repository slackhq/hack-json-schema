<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace \Facebook\TypeAssert;
use namespace Slack\Hack\JsonSchema;

class NullConstraint {
  public static function check(mixed $input, string $pointer): mixed {
    if ($input === null) {
      return $input;
    } else {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
        'message' => 'must provide a null pointer',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
