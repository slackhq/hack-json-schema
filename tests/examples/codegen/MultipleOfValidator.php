<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<2a4a4e3e9c399de1de58724be9cf4435>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TMultipleOfValidator = shape(
  ?'a_multiple_of_five_int' => int,
  ?'a_multiple_of_1_point_one_repeating_number' => num,
  ...
);

final class MultipleOfValidatorPropertiesAMultipleOfFiveInt {

  private static num $devisorForMultipleOf = 5;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMultipleOfConstraint::check(
      $typed,
      self::$devisorForMultipleOf,
      $pointer,
    );
    return $typed;
  }
}

final class MultipleOfValidatorPropertiesAMultipleOf1PointOneRepeatingNumber {

  private static num $devisorForMultipleOf = 1.1111111111111;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMultipleOfConstraint::check(
      $typed,
      self::$devisorForMultipleOf,
      $pointer,
    );
    return $typed;
  }
}

final class MultipleOfValidator
  extends JsonSchema\BaseValidator<TMultipleOfValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TMultipleOfValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'a_multiple_of_five_int')) {
      try {
        $output['a_multiple_of_five_int'] = MultipleOfValidatorPropertiesAMultipleOfFiveInt::check(
          $typed['a_multiple_of_five_int'],
          JsonSchema\get_pointer($pointer, 'a_multiple_of_five_int'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'a_multiple_of_1_point_one_repeating_number')) {
      try {
        $output['a_multiple_of_1_point_one_repeating_number'] = MultipleOfValidatorPropertiesAMultipleOf1PointOneRepeatingNumber::check(
          $typed['a_multiple_of_1_point_one_repeating_number'],
          JsonSchema\get_pointer($pointer, 'a_multiple_of_1_point_one_repeating_number'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }

  <<__Override>>
  protected function process(): TMultipleOfValidator {
    return self::check($this->input, $this->pointer);
  }
}
