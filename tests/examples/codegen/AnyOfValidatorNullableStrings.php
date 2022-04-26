<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<30cb8465f9ab8c97501247c1c65ac6a1>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorNullableStrings = ?string;

final class AnyOfValidatorNullableStringsAnyOf0 {

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

final class AnyOfValidatorNullableStringsAnyOf1 {

  private static int $minLength = 12;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $length = \mb_strlen($typed);
    Constraints\StringMinLengthConstraint::check(
      $length,
      self::$minLength,
      $pointer,
    );
    return $typed;
  }
}

final class AnyOfValidatorNullableStrings
  extends JsonSchema\BaseValidator<TAnyOfValidatorNullableStrings> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableStrings {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      AnyOfValidatorNullableStringsAnyOf0::check<>,
      AnyOfValidatorNullableStringsAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorNullableStrings {
    return self::check($this->input, $this->pointer);
  }
}
