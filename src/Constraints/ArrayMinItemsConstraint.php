<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class ArrayMinItemsConstraint {
  public static function check(int $num_items, int $min_items, string $pointer): void {
    if ($min_items > $num_items) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MIN_ITEMS,
          'expected' => $min_items,
          'got' => $num_items,
        ),
        'message' => "must provide at least {$min_items} items",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
