<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<4e71e0ec7d07d93792cc2bd02d3a3c8d>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExamplesNumericalSchema = shape(
  ?'integer' => int,
  ?'number' => num,
  ?'integer_coerce' => int,
  ?'number_coerce' => num,
  ?'hack_enum' => \Slack\Hack\JsonSchema\Tests\TestIntEnum,
  'integer_limits' => int,
  ...
);

final class ExamplesNumericalSchemaPropertiesInteger {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesNumericalSchemaPropertiesNumber {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesNumericalSchemaPropertiesIntegerCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesNumericalSchemaPropertiesNumberCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesNumericalSchemaPropertiesHackEnum {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): \Slack\Hack\JsonSchema\Tests\TestIntEnum {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    $typed = Constraints\HackEnumConstraint::check(
      $typed,
      \Slack\Hack\JsonSchema\Tests\TestIntEnum::class,
      $pointer,
    );
    return $typed;
  }
}

final class ExamplesNumericalSchemaPropertiesIntegerLimits {

  private static int $maximum = 10;
  private static int $minimum = 1;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMaximumConstraint::check(
      $typed,
      self::$maximum,
      $pointer,
    );
    Constraints\NumberMinimumConstraint::check(
      $typed,
      self::$minimum,
      $pointer,
    );
    return $typed;
  }
}

final class ExamplesNumericalSchema
  extends JsonSchema\BaseValidator<TExamplesNumericalSchema> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesNumericalSchema {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $defaults = dict[
      'integer_limits' => 5,
    ];
    $typed = \HH\Lib\Dict\merge($defaults, $typed);


    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'integer')) {
      try {
        $output['integer'] = ExamplesNumericalSchemaPropertiesInteger::check(
          $typed['integer'],
          JsonSchema\get_pointer($pointer, 'integer'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number')) {
      try {
        $output['number'] = ExamplesNumericalSchemaPropertiesNumber::check(
          $typed['number'],
          JsonSchema\get_pointer($pointer, 'number'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'integer_coerce')) {
      try {
        $output['integer_coerce'] = ExamplesNumericalSchemaPropertiesIntegerCoerce::check(
          $typed['integer_coerce'],
          JsonSchema\get_pointer($pointer, 'integer_coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number_coerce')) {
      try {
        $output['number_coerce'] = ExamplesNumericalSchemaPropertiesNumberCoerce::check(
          $typed['number_coerce'],
          JsonSchema\get_pointer($pointer, 'number_coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'hack_enum')) {
      try {
        $output['hack_enum'] = ExamplesNumericalSchemaPropertiesHackEnum::check(
          $typed['hack_enum'],
          JsonSchema\get_pointer($pointer, 'hack_enum'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'integer_limits')) {
      try {
        $output['integer_limits'] = ExamplesNumericalSchemaPropertiesIntegerLimits::check(
          $typed['integer_limits'],
          JsonSchema\get_pointer($pointer, 'integer_limits'),
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
  protected function process(): TExamplesNumericalSchema {
    return self::check($this->input, $this->pointer);
  }
}
