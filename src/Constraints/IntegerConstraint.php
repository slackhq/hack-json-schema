<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace \Facebook\{TypeAssert, TypeCoerce};
use namespace Slack\Hack\JsonSchema;

class IntegerConstraint {
  public static function check(
    mixed $input,
    string $pointer,
    bool $coerce,
  ): int {
    if ($coerce) {
      try {
        return TypeCoerce\int($input);
      } catch (TypeAssert\TypeCoercionException $e) {
        $error = shape(
          'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
          'message' => 'must provide a number',
        );
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      }
    }

    try {
      return TypeAssert\int($input);
    } catch (TypeAssert\IncorrectTypeException $e) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
        'message' => 'must provide an integer',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
