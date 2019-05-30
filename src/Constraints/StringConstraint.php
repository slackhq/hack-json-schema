<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace \Facebook\{TypeAssert, TypeCoerce};

use namespace Slack\Hack\JsonSchema;

class StringConstraint {
  public static function check(
    mixed $input,
    string $pointer,
    bool $coerce,
  ): string {
    if ($coerce) {
      try {
        return TypeCoerce\string($input);
      } catch (TypeAssert\TypeCoercionException $e) {
        $error = shape(
          'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
          'message' => 'must provide a string',
        );
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      }
    }

    try {
      return TypeAssert\string($input);
    } catch (TypeAssert\IncorrectTypeException $e) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
        'message' => 'must provide a string',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
