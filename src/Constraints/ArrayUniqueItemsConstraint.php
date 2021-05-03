<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace HH\Lib\C;
use namespace Slack\Hack\JsonSchema;

class ArrayUniqueItemsConstraint {
  public static function check<T as arraykey>(vec<T> $input, string $pointer, bool $coerce): keyset<T> {
    $output = keyset($input);
    if (!$coerce && C\count($output) < C\count($input)) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::UNIQUE_ITEMS,
          'got' => $input,
        ),
        'message' => 'Input contains duplicate items',
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
    return $output;
  }
}
