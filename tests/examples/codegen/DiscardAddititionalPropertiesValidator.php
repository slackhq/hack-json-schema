<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<acd5ef94c194a2857bad21b535552de2>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TDiscardAddititionalPropertiesValidatorPropertiesOnlyAdditionalProperties = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesOnlyProperties = shape(
  'string' => string,
  'number' => num,
  'required_string' => string,
);

type TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalProperties = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRef = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArray = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidator = shape(
  ?'only_additional_properties' => TDiscardAddititionalPropertiesValidatorPropertiesOnlyAdditionalProperties,
  ?'only_properties' => TDiscardAddititionalPropertiesValidatorPropertiesOnlyProperties,
  ?'additional_properties_ref' => TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRef,
  ?'additional_properties_array' => TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArray,
  ...
);

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesOnlyAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyPropertiesPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyPropertiesPropertiesNumber {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyPropertiesPropertiesRequiredString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyProperties {

  private static keyset<string> $required = keyset[
    'required_string',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'string',
    'number',
    'required_string',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesOnlyProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $defaults = dict[
      'string' => 'optional_default',
      'number' => 3,
      'required_string' => 'required_default',
    ];
    $typed = \HH\Lib\Dict\merge($defaults, $typed);

    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'string')) {
      try {
        $output['string'] = DiscardAddititionalPropertiesValidatorPropertiesOnlyPropertiesPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number')) {
      try {
        $output['number'] = DiscardAddititionalPropertiesValidatorPropertiesOnlyPropertiesPropertiesNumber::check(
          $typed['number'],
          JsonSchema\get_pointer($pointer, 'number'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'required_string')) {
      try {
        $output['required_string'] = DiscardAddititionalPropertiesValidatorPropertiesOnlyPropertiesPropertiesRequiredString::check(
          $typed['required_string'],
          JsonSchema\get_pointer($pointer, 'required_string'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalPropertiesItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalProperties {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalPropertiesItems::check(
          $value,
          JsonSchema\get_pointer($pointer, (string) $index),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      try {
        $output[$key] = DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalProperties::check(
          $value,
          JsonSchema\get_pointer($pointer, $key),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRef {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRef {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      try {
        $output[$key] = DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalProperties::check(
          $value,
          JsonSchema\get_pointer($pointer, $key),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArrayAdditionalPropertiesItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArrayAdditionalProperties {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArrayAdditionalPropertiesItems::check(
          $value,
          JsonSchema\get_pointer($pointer, (string) $index),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArray {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArray {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      try {
        $output[$key] = DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArrayAdditionalProperties::check(
          $value,
          JsonSchema\get_pointer($pointer, $key),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidator
  extends JsonSchema\BaseValidator<TDiscardAddititionalPropertiesValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'only_additional_properties')) {
      try {
        $output['only_additional_properties'] = DiscardAddititionalPropertiesValidatorPropertiesOnlyAdditionalProperties::check(
          $typed['only_additional_properties'],
          JsonSchema\get_pointer($pointer, 'only_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'only_properties')) {
      try {
        $output['only_properties'] = DiscardAddititionalPropertiesValidatorPropertiesOnlyProperties::check(
          $typed['only_properties'],
          JsonSchema\get_pointer($pointer, 'only_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'additional_properties_ref')) {
      try {
        $output['additional_properties_ref'] = DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRef::check(
          $typed['additional_properties_ref'],
          JsonSchema\get_pointer($pointer, 'additional_properties_ref'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'additional_properties_array')) {
      try {
        $output['additional_properties_array'] = DiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArray::check(
          $typed['additional_properties_array'],
          JsonSchema\get_pointer($pointer, 'additional_properties_array'),
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
  protected function process(): TDiscardAddititionalPropertiesValidator {
    return self::check($this->input, $this->pointer);
  }
}
