<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<c1940fa688271ce27b41f85f8b502a40>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorNestedNullableAnyOfAnyOf1 = ?num;

type TAnyOfValidatorNestedNullableAnyOf = ?num;

final class AnyOfValidatorNestedNullableAnyOfAnyOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorNestedNullableAnyOfAnyOf1AnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorNestedNullableAnyOfAnyOf1 {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNestedNullableAnyOfAnyOf1 {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      AnyOfValidatorNestedNullableAnyOfAnyOf1AnyOf1::check<>,
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
}

final class AnyOfValidatorNestedNullableAnyOf
  extends JsonSchema\BaseValidator<TAnyOfValidatorNestedNullableAnyOf> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNestedNullableAnyOf {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      AnyOfValidatorNestedNullableAnyOfAnyOf0::check<>,
      AnyOfValidatorNestedNullableAnyOfAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorNestedNullableAnyOf {
    return self::check($this->input, $this->pointer);
  }
}
