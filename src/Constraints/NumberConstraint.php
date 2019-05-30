<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace \Facebook\{TypeAssert, TypeCoerce};
use namespace Slack\Hack\JsonSchema;

class NumberConstraint {
  public static function check(
    mixed $input,
    string $pointer,
    bool $coerce,
  ): num {
    if ($coerce) {
      try {
        return TypeCoerce\num($input);
      } catch (TypeAssert\TypeCoercionException $e) {
        $error = shape(
          'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
          'message' => 'must provide a number',
        );
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      }
    }

    try {
      return TypeAssert\num($input);
    } catch (TypeAssert\IncorrectTypeException $e) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
        'message' => 'must provide a number',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
