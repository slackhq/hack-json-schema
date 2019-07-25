<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<43aa876feebcce18e822ca48582334ca>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TStringSchemaValidator = shape(
  ?'simple' => string,
  ?'coerce' => string,
  ?'sanitize_uniline' => string,
  ?'sanitize_multiline' => string,
  ?'date_format' => string,
  ...
);

<<Codegen>>
final class StringSchemaValidatorPropertiesSimple {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

<<Codegen>>
final class StringSchemaValidatorPropertiesCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

<<Codegen>>
final class StringSchemaValidatorPropertiesSanitizeUniline {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $sanitize_string =
      fun('\Slack\Hack\JsonSchema\Tests\_string_schema_validator_test_uniline');
    $typed = $sanitize_string($typed);

    return $typed;
  }
}

<<Codegen>>
final class StringSchemaValidatorPropertiesSanitizeMultiline {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $sanitize_string =
      fun('\Slack\Hack\JsonSchema\Tests\_string_schema_validator_test_multiline');
    $typed = $sanitize_string($typed);

    return $typed;
  }
}

<<Codegen>>
final class StringSchemaValidatorPropertiesDateFormat {

  private static string $format = 'date';
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\StringFormatConstraint::check($typed, self::$format, $pointer);
    return $typed;
  }
}

<<Codegen>>
final class StringSchemaValidator
  extends JsonSchema\BaseValidator<TStringSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TStringSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'simple')) {
      try {
        $output['simple'] = StringSchemaValidatorPropertiesSimple::check(
          $typed['simple'],
          JsonSchema\get_pointer($pointer, 'simple'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'coerce')) {
      try {
        $output['coerce'] = StringSchemaValidatorPropertiesCoerce::check(
          $typed['coerce'],
          JsonSchema\get_pointer($pointer, 'coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'sanitize_uniline')) {
      try {
        $output['sanitize_uniline'] = StringSchemaValidatorPropertiesSanitizeUniline::check(
          $typed['sanitize_uniline'],
          JsonSchema\get_pointer($pointer, 'sanitize_uniline'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'sanitize_multiline')) {
      try {
        $output['sanitize_multiline'] = StringSchemaValidatorPropertiesSanitizeMultiline::check(
          $typed['sanitize_multiline'],
          JsonSchema\get_pointer($pointer, 'sanitize_multiline'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'date_format')) {
      try {
        $output['date_format'] = StringSchemaValidatorPropertiesDateFormat::check(
          $typed['date_format'],
          JsonSchema\get_pointer($pointer, 'date_format'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4057] */
    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }

  <<__Override>>
  final protected function process(): TStringSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
