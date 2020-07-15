<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use type Facebook\TypeAssert\{TypeCoercionException};
use namespace Facebook\TypeSpec;
use namespace Slack\Hack\JsonSchema;

class ArrayConstraint {
  public static function check(
    mixed $input,
    string $pointer,
    bool $coerce,
  ): vec<mixed> {
    if ($coerce && $input is string) {
      $coerced = JsonSchema\json_decode_hack($input);

      // Different OSes can parse JSON differently. If `$coerced` is null, we
      // assume JSON decoding failed. If `$coerced` is not a `Traversable`, it
      // failed decoding to an array. To support form encoded arrays, we'll
      // check to see if we can create an array from a comma delimited string.
      $valid_json = $coerced is nonnull && $coerced is Traversable<_>;
      if (!$valid_json) {
        // Wrap in brackets and try JSON decoding again. This'll result in
        // correctly typed output for non-string form encoded arrays.
        $coerced = JsonSchema\json_decode_hack("[{$input}]");
      }

      $input = $coerced;
    }

    $spec = TypeSpec\vec(TypeSpec\mixed());
    try {
      # To allow for either PHP or hack arrays, we coerce to a vec here.
      return $spec->coerceType($input);
    } catch (TypeCoercionException $e) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
        'message' => 'must provide an array',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
