<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<0a61a4d8cd764d9ef92d0ac04da6ccac>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorStrings = string;

final class AnyOfValidatorStringsAnyOf1 {

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

final class AnyOfValidatorStrings
  extends JsonSchema\BaseValidator<TAnyOfValidatorStrings> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorStrings {
    $constraints = vec[
      ExamplesStringSchemaDefinitionsMaxLength::check<>,
      AnyOfValidatorStringsAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorStrings {
    return self::check($this->input, $this->pointer);
  }
}
