<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Facebook\TypeAssert;
use namespace Slack\Hack\JsonSchema;
use namespace HH\Lib\Str;

class BooleanConstraint {
  public static function check(mixed $input, string $pointer, bool $coerce): bool {
    if ($coerce) {
      if (Str\lowercase((string)$input) === 'false') {
        return false;
      }

      if ($input === '0') {
        return false;
      }

      if ($input is nonnull && $input) {
        return true;
      }

      return false;
    }

    try {
      return TypeAssert\bool($input);
    } catch (TypeAssert\IncorrectTypeException $e) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
        'message' => 'must be a boolean',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
