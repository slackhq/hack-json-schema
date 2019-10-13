<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Facebook\{TypeAssert, TypeSpec};

use namespace Slack\Hack\JsonSchema;

class ObjectConstraint {
  public static function check(mixed $input, string $pointer, bool $coerce): dict<string, mixed> {
    if ($coerce && $input is string) {
      $input = JsonSchema\json_decode_hack($input);
    }

    $dict_spec = TypeSpec\dict(TypeSpec\string(), TypeSpec\mixed());

    # This will first attempt to assert that the incoming input is a `dict`. We
    # can't use `coerceType` from `DictSpec` here because given a dict-like
    # PHP array, it would successfully coerce it into a dict. For JSON
    # schema, that should be considered invalid: passing an array when we
    # expect an object is an invalid input.
    try {
      if ($input is dict<_, _>) {
        return $dict_spec->assertType($input);
      } else {
        $darray_spec = TypeSpec\dict_like_array(TypeSpec\string(), TypeSpec\mixed());
        # Fallback to checking legacy PHP dict-like-arrays
        $darray_spec->assertType($input);

        # Coerce a valid dict-like-array to a dict.
        return $dict_spec->coerceType($input);
      }
    } catch (TypeAssert\IncorrectTypeException $e) {
      self::throwInvalidInput($pointer);
    } catch (TypeAssert\TypeCoercionException $e) {
      self::throwInvalidInput($pointer);
    }

  }

  private static function throwInvalidInput(string $pointer): noreturn {
    $error = shape(
      'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
      'message' => 'must provide an object',
    );
    throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
  }
}
