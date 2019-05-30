<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace \Facebook\TypeAssert;
use namespace \Facebook\TypeSpec;

use namespace Slack\Hack\JsonSchema;

class ObjectConstraint {
  public static function check(
    mixed $input,
    string $pointer,
    bool $coerce,
  ): dict<string, mixed> {
    if ($coerce && $input is string) {
      $input = JsonSchema\json_decode_hack($input);
    }

    # This will first attempt to assert that the incoming input is a `dict`. We
    # can't use `coerceType` from `DictSpec` here because given a dict-like
    # PHP array, it would successfully coerce it into a dict. For JSON
    # schema, that should be considered invalid: passing an array when we
    # expect an object is an invalid input.
    $spec = TypeSpec\dict(TypeSpec\string(), TypeSpec\mixed());
    try {
      return $spec->assertType($input);
    } catch (TypeAssert\TypeCoercionException $e) {

      # Fallback to checking legacy PHP dict-like-arrays
      $fallback = TypeSpec\dict_like_array(TypeSpec\string(), TypeSpec\mixed());
      try {
        $fallback->assertType($input);

        # Coerce a valid dict-like-array to a dict.
        return $spec->coerceType($input);
      } catch (TypeAssert\TypeCoercionException $e) {
        $error = shape(
          'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
          'message' => 'must provide an object',
        );
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      } catch (TypeAssert\IncorrectTypeException $e) {
        $error = shape(
          'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
          'message' => 'must provide an object',
        );
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      }
    } catch (TypeAssert\IncorrectTypeException $e) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
        'message' => 'must provide an object',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
