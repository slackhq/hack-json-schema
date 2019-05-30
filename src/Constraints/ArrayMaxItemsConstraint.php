<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class ArrayMaxItemsConstraint {
  public static function check(
    int $num_items,
    int $max_items,
    string $pointer,
  ): void {
    if ($num_items > $max_items) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::MAX_ITEMS,
          'expected' => $max_items,
          'got' => $num_items,
        ),
        'message' => "no more than {$max_items} items allowed",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
  }
}
