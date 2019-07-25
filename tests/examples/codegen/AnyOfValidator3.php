<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<5c62c8d3bc86a19435c46944580d9e81>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidator3 = mixed;

final class AnyOfValidator3AnyOf0 {

  public static function check(mixed $input, string $pointer): mixed {
    $typed = Constraints\NullConstraint::check($input, $pointer);

    return $typed;
  }
}

final class AnyOfValidator3AnyOf1 {

  public static function check(mixed $input, string $pointer): mixed {
    $typed = Constraints\NullConstraint::check($input, $pointer);

    return $typed;
  }
}

final class AnyOfValidator3 extends JsonSchema\BaseValidator<TAnyOfValidator3> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidator3 {
    $constraints = vec[
      class_meth(AnyOfValidator3AnyOf0::class, 'check'),
      class_meth(AnyOfValidator3AnyOf1::class, 'check'),
    ];
    $errors = vec[
    ];

    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($input, $pointer);
        return $output;
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $error = shape(
      'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
      'constraint' => shape(
        'type' => JsonSchema\FieldErrorConstraint::ANY_OF,
      ),
      'message' => "failed to match any allowed schemas",
    );

    $output_errors = vec[$error];
    $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
    throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
  }

  <<__Override>>
  final protected function process(): TAnyOfValidator3 {
    return self::check($this->input, $this->pointer);
  }
}
