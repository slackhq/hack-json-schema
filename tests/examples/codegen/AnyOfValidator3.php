<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<f75639f4e8e44660c38760a9b0e53aa6>>
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
      AnyOfValidator3AnyOf0::check<>,
      AnyOfValidator3AnyOf1::check<>,
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
      'message' => 'failed to match any allowed schemas',
    );

    $output_errors = vec[$error];
    $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
    throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
  }

  <<__Override>>
  protected function process(): TAnyOfValidator3 {
    return self::check($this->input, $this->pointer);
  }
}
