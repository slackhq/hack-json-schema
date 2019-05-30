<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<c3aaab3b3969ac5c72fda97f3a938d6e>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExamplesStringSchema = shape(
  ?'simple' => string,
  ?'coerce' => string,
  ?'sanitize_uniline' => string,
  ?'sanitize_multiline' => string,
  ?'date_format' => string,
  ...
);

<<Codegen>>
final class ExamplesStringSchemaPropertiesSimple {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

<<Codegen>>
final class ExamplesStringSchemaPropertiesSanitizeUniline {

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
final class ExamplesStringSchemaPropertiesSanitizeMultiline {

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
final class ExamplesStringSchemaPropertiesDateFormat {

  private static string $format = 'date';
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\StringFormatConstraint::check($typed, self::$format, $pointer);
    return $typed;
  }
}

<<Codegen>>
final class ExamplesStringSchema
  extends JsonSchema\BaseValidator<TExamplesStringSchema> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesStringSchema {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'simple')) {
      try {
        $output['simple'] = ExamplesStringSchemaPropertiesSimple::check(
          $typed['simple'],
          JsonSchema\get_pointer($pointer, 'simple'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'coerce')) {
      try {
        $output['coerce'] = ExamplesStringSchemaDefinitionsCoerce::check(
          $typed['coerce'],
          JsonSchema\get_pointer($pointer, 'coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'sanitize_uniline')) {
      try {
        $output['sanitize_uniline'] = ExamplesStringSchemaPropertiesSanitizeUniline::check(
          $typed['sanitize_uniline'],
          JsonSchema\get_pointer($pointer, 'sanitize_uniline'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'sanitize_multiline')) {
      try {
        $output['sanitize_multiline'] = ExamplesStringSchemaPropertiesSanitizeMultiline::check(
          $typed['sanitize_multiline'],
          JsonSchema\get_pointer($pointer, 'sanitize_multiline'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'date_format')) {
      try {
        $output['date_format'] = ExamplesStringSchemaPropertiesDateFormat::check(
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

  final protected function process(): TExamplesStringSchema {
    return self::check($this->input, $this->pointer);
  }
}
