<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<1fcce3f662ef3516f81c2f1dbfc52cc9>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorNullableArraykey = ?arraykey;

final class AnyOfValidatorNullableArraykeyAnyOf0 {

  private static int $maxLength = 10;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $length = \mb_strlen($typed);
    Constraints\StringMaxLengthConstraint::check(
      $length,
      self::$maxLength,
      $pointer,
    );
    return $typed;
  }
}

final class AnyOfValidatorNullableArraykeyAnyOf1 {

  private static int $maximum = 10;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMaximumConstraint::check(
      $typed,
      self::$maximum,
      $pointer,
    );
    return $typed;
  }
}

final class AnyOfValidatorNullableArraykey
  extends JsonSchema\BaseValidator<TAnyOfValidatorNullableArraykey> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableArraykey {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      AnyOfValidatorNullableArraykeyAnyOf0::check<>,
      AnyOfValidatorNullableArraykeyAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorNullableArraykey {
    return self::check($this->input, $this->pointer);
  }
}
