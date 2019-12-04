<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<0be2e25fbadc729ea755b7308f933ca5>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TEnumSchemaValidator = shape(
  ?'enum_string' => string,
  ?'enum_number' => num,
  ...
);

final class EnumSchemaValidatorPropertiesEnumString {

  private static vec<mixed> $enum = vec[
    'one',
    'two',
    'three',
  ];
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\EnumConstraint::check($typed, self::$enum, $pointer);
    return $typed;
  }
}

final class EnumSchemaValidatorPropertiesEnumNumber {

  private static vec<mixed> $enum = vec[
    1,
    2,
    3,
  ];
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    Constraints\EnumConstraint::check($typed, self::$enum, $pointer);
    return $typed;
  }
}

final class EnumSchemaValidator
  extends JsonSchema\BaseValidator<TEnumSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TEnumSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'enum_string')) {
      try {
        $output['enum_string'] = EnumSchemaValidatorPropertiesEnumString::check(
          $typed['enum_string'],
          JsonSchema\get_pointer($pointer, 'enum_string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'enum_number')) {
      try {
        $output['enum_number'] = EnumSchemaValidatorPropertiesEnumNumber::check(
          $typed['enum_number'],
          JsonSchema\get_pointer($pointer, 'enum_number'),
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
  final protected function process(): TEnumSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
