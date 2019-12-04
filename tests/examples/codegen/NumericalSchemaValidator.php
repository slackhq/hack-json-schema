<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<8901247352f463bc0f00f4c56a43d8e2>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TNumericalSchemaValidator = shape(
  ?'integer' => int,
  ?'number' => num,
  ?'integer_coerce' => int,
  ?'number_coerce' => num,
  ...
);

final class NumericalSchemaValidatorPropertiesInteger {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class NumericalSchemaValidatorPropertiesNumber {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class NumericalSchemaValidatorPropertiesIntegerCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class NumericalSchemaValidatorPropertiesNumberCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class NumericalSchemaValidator
  extends JsonSchema\BaseValidator<TNumericalSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TNumericalSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'integer')) {
      try {
        $output['integer'] = NumericalSchemaValidatorPropertiesInteger::check(
          $typed['integer'],
          JsonSchema\get_pointer($pointer, 'integer'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number')) {
      try {
        $output['number'] = NumericalSchemaValidatorPropertiesNumber::check(
          $typed['number'],
          JsonSchema\get_pointer($pointer, 'number'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'integer_coerce')) {
      try {
        $output['integer_coerce'] = NumericalSchemaValidatorPropertiesIntegerCoerce::check(
          $typed['integer_coerce'],
          JsonSchema\get_pointer($pointer, 'integer_coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number_coerce')) {
      try {
        $output['number_coerce'] = NumericalSchemaValidatorPropertiesNumberCoerce::check(
          $typed['number_coerce'],
          JsonSchema\get_pointer($pointer, 'number_coerce'),
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
  final protected function process(): TNumericalSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
