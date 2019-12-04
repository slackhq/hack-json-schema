<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<8958a4d059f6c0f104b60ec3bc240f24>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TDefaultsSchemaValidatorPropertiesNestedCoerceFalse = shape(
  ?'boolean_prop' => bool,
  ?'number_prop' => num,
  ...
);

type TDefaultsSchemaValidator = shape(
  ?'boolean' => bool,
  ?'boolean_coerce_false' => bool,
  ?'nested_coerce_false' => TDefaultsSchemaValidatorPropertiesNestedCoerceFalse,
  ...
);

final class DefaultsSchemaValidatorPropertiesBoolean {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class DefaultsSchemaValidatorPropertiesBooleanCoerceFalse {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class DefaultsSchemaValidatorPropertiesNestedCoerceFalsePropertiesBooleanProp {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class DefaultsSchemaValidatorPropertiesNestedCoerceFalsePropertiesNumberProp {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DefaultsSchemaValidatorPropertiesNestedCoerceFalse {

  private static bool $coerce = true;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDefaultsSchemaValidatorPropertiesNestedCoerceFalse {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'boolean_prop')) {
      try {
        $output['boolean_prop'] = DefaultsSchemaValidatorPropertiesNestedCoerceFalsePropertiesBooleanProp::check(
          $typed['boolean_prop'],
          JsonSchema\get_pointer($pointer, 'boolean_prop'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number_prop')) {
      try {
        $output['number_prop'] = DefaultsSchemaValidatorPropertiesNestedCoerceFalsePropertiesNumberProp::check(
          $typed['number_prop'],
          JsonSchema\get_pointer($pointer, 'number_prop'),
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
}

final class DefaultsSchemaValidator
  extends JsonSchema\BaseValidator<TDefaultsSchemaValidator> {

  private static bool $coerce = true;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDefaultsSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'boolean')) {
      try {
        $output['boolean'] = DefaultsSchemaValidatorPropertiesBoolean::check(
          $typed['boolean'],
          JsonSchema\get_pointer($pointer, 'boolean'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'boolean_coerce_false')) {
      try {
        $output['boolean_coerce_false'] = DefaultsSchemaValidatorPropertiesBooleanCoerceFalse::check(
          $typed['boolean_coerce_false'],
          JsonSchema\get_pointer($pointer, 'boolean_coerce_false'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'nested_coerce_false')) {
      try {
        $output['nested_coerce_false'] = DefaultsSchemaValidatorPropertiesNestedCoerceFalse::check(
          $typed['nested_coerce_false'],
          JsonSchema\get_pointer($pointer, 'nested_coerce_false'),
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
  final protected function process(): TDefaultsSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
