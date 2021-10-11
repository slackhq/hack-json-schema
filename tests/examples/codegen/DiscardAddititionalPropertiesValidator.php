<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<79c457344a7c80630eb3e29d65e7c000>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TDiscardAddititionalPropertiesValidatorPropertiesOnlyAdditionalProperties = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesOnlyNoAdditionalProperties = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesOnlyProperties = shape(
  'string' => string,
  'number' => num,
  'required_string' => string,
);

type TDiscardAddititionalPropertiesValidatorPropertiesDefaults = shape(
  'required_string' => string,
  'default_string' => string,
);

type TDiscardAddititionalPropertiesValidatorPropertiesOnlyPatternProperties = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyString = dict<string, string>;

type TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObjectPatternProperties0 = shape(
  'sample' => string,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObject = dict<string, TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObjectPatternProperties0>;

type TDiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalProperties = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternProperties = shape(
  ?'string' => string,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional = shape(
  ?'string' => string,
);

type TDiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond = shape(
  ?'last' => string,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirst = shape(
  ?'second' => TDiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesNestedObject = shape(
  ?'first' => TDiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirst,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesCoerceObject = shape(
  ?'first' => string,
  ?'second' => num,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesImplicitAdditionalProperties = shape(
  ?'first' => string,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesExplicitAdditionalProperties = shape(
  ?'first' => string,
  ...
);

type TDiscardAddititionalPropertiesValidatorPropertiesNoAdditionalProperties = shape(
  ?'first' => string,
);

type TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArray = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRefAdditionalProperties = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRef = dict<string, mixed>;

type TDiscardAddititionalPropertiesValidator = shape(
  ?'only_additional_properties' => TDiscardAddititionalPropertiesValidatorPropertiesOnlyAdditionalProperties,
  ?'only_no_additional_properties' => TDiscardAddititionalPropertiesValidatorPropertiesOnlyNoAdditionalProperties,
  ?'only_properties' => TDiscardAddititionalPropertiesValidatorPropertiesOnlyProperties,
  ?'defaults' => TDiscardAddititionalPropertiesValidatorPropertiesDefaults,
  ?'only_pattern_properties' => TDiscardAddititionalPropertiesValidatorPropertiesOnlyPatternProperties,
  ?'single_pattern_property_string' => TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyString,
  ?'single_pattern_property_object' => TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObject,
  ?'pattern_properties_no_additional_properties' => TDiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalProperties,
  ?'properties_and_pattern_properties' => TDiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternProperties,
  ?'properties_and_pattern_properties_no_additional' => TDiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional,
  ?'nested_object' => TDiscardAddititionalPropertiesValidatorPropertiesNestedObject,
  ?'coerce_object' => TDiscardAddititionalPropertiesValidatorPropertiesCoerceObject,
  ?'implicit_additional_properties' => TDiscardAddititionalPropertiesValidatorPropertiesImplicitAdditionalProperties,
  ?'explicit_additional_properties' => TDiscardAddititionalPropertiesValidatorPropertiesExplicitAdditionalProperties,
  ?'no_additional_properties' => TDiscardAddititionalPropertiesValidatorPropertiesNoAdditionalProperties,
  ?'additional_properties_array' => TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesArray,
  ?'additional_properties_ref' => TDiscardAddititionalPropertiesValidatorPropertiesAdditionalPropertiesRef,
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

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyNoAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesOnlyNoAdditionalProperties {
    // Hack to prevent us from having to change the params names when we are not
    // using them.
    $_ = $input;
    $_ = $pointer;
    return dict[];
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

final class DiscardAddititionalPropertiesValidatorPropertiesDefaultsPropertiesRequiredString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesDefaultsPropertiesDefaultString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesDefaults {

  private static keyset<string> $required = keyset[
    'required_string',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'required_string',
    'default_string',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesDefaults {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $defaults = dict[
      'default_string' => 'test',
    ];
    $typed = \HH\Lib\Dict\merge($defaults, $typed);

    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'required_string')) {
      try {
        $output['required_string'] = DiscardAddititionalPropertiesValidatorPropertiesDefaultsPropertiesRequiredString::check(
          $typed['required_string'],
          JsonSchema\get_pointer($pointer, 'required_string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'default_string')) {
      try {
        $output['default_string'] = DiscardAddititionalPropertiesValidatorPropertiesDefaultsPropertiesDefaultString::check(
          $typed['default_string'],
          JsonSchema\get_pointer($pointer, 'default_string'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyPatternPropertiesPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyPatternPropertiesPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesOnlyPatternProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesOnlyPatternProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        DiscardAddititionalPropertiesValidatorPropertiesOnlyPatternPropertiesPatternProperties0::check<>,
      '^I_' =>
        DiscardAddititionalPropertiesValidatorPropertiesOnlyPatternPropertiesPatternProperties1::check<>,
    ];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      $passed_any = false;
      $failed_any = false;

      foreach ($patterns as $pattern => $constraint) {
        if (\preg_match("/{$pattern}/", $key)) {
          try {
            $output[$key] = $constraint(
              $value,
              JsonSchema\get_pointer($pointer, $key),
            );
            if (!$passed_any) {
              $passed_any = true;
            }
          } catch (JsonSchema\InvalidFieldException $e) {
            $errors = \HH\Lib\Vec\concat($errors, $e->errors);
            if (!$failed_any) {
              $failed_any = true;
            }
          }
        }
      }

      if ($passed_any || $failed_any) {
        continue;
      }

    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyStringPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyString {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyString {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyStringPatternProperties0::check<>,
    ];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      $passed_any = false;
      $failed_any = false;

      foreach ($patterns as $pattern => $constraint) {
        if (\preg_match("/{$pattern}/", $key)) {
          try {
            $output[$key] = $constraint(
              $value,
              JsonSchema\get_pointer($pointer, $key),
            );
            if (!$passed_any) {
              $passed_any = true;
            }
          } catch (JsonSchema\InvalidFieldException $e) {
            $errors = \HH\Lib\Vec\concat($errors, $e->errors);
            if (!$failed_any) {
              $failed_any = true;
            }
          }
        }
      }

      if ($passed_any || $failed_any) {
        continue;
      }

    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObjectPatternProperties0PropertiesSample {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObjectPatternProperties0 {

  private static keyset<string> $required = keyset[
    'sample',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObjectPatternProperties0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'sample')) {
      try {
        $output['sample'] = DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObjectPatternProperties0PropertiesSample::check(
          $typed['sample'],
          JsonSchema\get_pointer($pointer, 'sample'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObject {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObject {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObjectPatternProperties0::check<>,
    ];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      $passed_any = false;
      $failed_any = false;

      foreach ($patterns as $pattern => $constraint) {
        if (\preg_match("/{$pattern}/", $key)) {
          try {
            $output[$key] = $constraint(
              $value,
              JsonSchema\get_pointer($pointer, $key),
            );
            if (!$passed_any) {
              $passed_any = true;
            }
          } catch (JsonSchema\InvalidFieldException $e) {
            $errors = \HH\Lib\Vec\concat($errors, $e->errors);
            if (!$failed_any) {
              $failed_any = true;
            }
          }
        }
      }

      if ($passed_any || $failed_any) {
        continue;
      }

    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        DiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties0::check<>,
      '^I_' =>
        DiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties1::check<>,
    ];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      $passed_any = false;
      $failed_any = false;

      foreach ($patterns as $pattern => $constraint) {
        if (\preg_match("/{$pattern}/", $key)) {
          try {
            $output[$key] = $constraint(
              $value,
              JsonSchema\get_pointer($pointer, $key),
            );
            if (!$passed_any) {
              $passed_any = true;
            }
          } catch (JsonSchema\InvalidFieldException $e) {
            $errors = \HH\Lib\Vec\concat($errors, $e->errors);
            if (!$failed_any) {
              $failed_any = true;
            }
          }
        }
      }

      if ($passed_any || $failed_any) {
        continue;
      }

      $errors[] = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'message' => "invalid additional property: {$key}",
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ADDITIONAL_PROPERTIES,
          'got' => $key,
        ),
      );
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternProperties {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'string',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'string')) {
      try {
        $output['string'] = DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $patterns = dict[
      '^S_' =>
        DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties0::check<>,
      '^I_' =>
        DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties1::check<>,
    ];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      if (\HH\Lib\C\contains_key(self::$properties, $key)) {
        continue;
      }

      $passed_any = false;
      $failed_any = false;

      foreach ($patterns as $pattern => $constraint) {
        if (\preg_match("/{$pattern}/", $key)) {
          try {
            $constraint($value, JsonSchema\get_pointer($pointer, $key));
            if (!$passed_any) {
              $passed_any = true;
            }
          } catch (JsonSchema\InvalidFieldException $e) {
            $errors = \HH\Lib\Vec\concat($errors, $e->errors);
            if (!$failed_any) {
              $failed_any = true;
            }
          }
        }
      }

      if ($passed_any || $failed_any) {
        continue;
      }

    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'string',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'string')) {
      try {
        $output['string'] = DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $patterns = dict[
      '^S_' =>
        DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties0::check<>,
      '^I_' =>
        DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties1::check<>,
    ];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      if (\HH\Lib\C\contains_key(self::$properties, $key)) {
        continue;
      }

      $passed_any = false;
      $failed_any = false;

      foreach ($patterns as $pattern => $constraint) {
        if (\preg_match("/{$pattern}/", $key)) {
          try {
            $constraint($value, JsonSchema\get_pointer($pointer, $key));
            if (!$passed_any) {
              $passed_any = true;
            }
          } catch (JsonSchema\InvalidFieldException $e) {
            $errors = \HH\Lib\Vec\concat($errors, $e->errors);
            if (!$failed_any) {
              $failed_any = true;
            }
          }
        }
      }

      if ($passed_any || $failed_any) {
        continue;
      }

      $errors[] = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'message' => "invalid additional property: {$key}",
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ADDITIONAL_PROPERTIES,
          'got' => $key,
        ),
      );
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecondPropertiesLast {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'last')) {
      try {
        $output['last'] = DiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecondPropertiesLast::check(
          $typed['last'],
          JsonSchema\get_pointer($pointer, 'last'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirst {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirst {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'second')) {
      try {
        $output['second'] = DiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond::check(
          $typed['second'],
          JsonSchema\get_pointer($pointer, 'second'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesNestedObject {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesNestedObject {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = DiscardAddititionalPropertiesValidatorPropertiesNestedObjectPropertiesFirst::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesCoerceObjectPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesCoerceObjectPropertiesSecond {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesCoerceObject {

  private static bool $coerce = true;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesCoerceObject {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = DiscardAddititionalPropertiesValidatorPropertiesCoerceObjectPropertiesFirst::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'second')) {
      try {
        $output['second'] = DiscardAddititionalPropertiesValidatorPropertiesCoerceObjectPropertiesSecond::check(
          $typed['second'],
          JsonSchema\get_pointer($pointer, 'second'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesImplicitAdditionalPropertiesPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesImplicitAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesImplicitAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = DiscardAddititionalPropertiesValidatorPropertiesImplicitAdditionalPropertiesPropertiesFirst::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesExplicitAdditionalPropertiesPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesExplicitAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesExplicitAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = DiscardAddititionalPropertiesValidatorPropertiesExplicitAdditionalPropertiesPropertiesFirst::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
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

final class DiscardAddititionalPropertiesValidatorPropertiesNoAdditionalPropertiesPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class DiscardAddititionalPropertiesValidatorPropertiesNoAdditionalProperties {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'first',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TDiscardAddititionalPropertiesValidatorPropertiesNoAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = DiscardAddititionalPropertiesValidatorPropertiesNoAdditionalPropertiesPropertiesFirst::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
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

    if (\HH\Lib\C\contains_key($typed, 'only_no_additional_properties')) {
      try {
        $output['only_no_additional_properties'] = DiscardAddititionalPropertiesValidatorPropertiesOnlyNoAdditionalProperties::check(
          $typed['only_no_additional_properties'],
          JsonSchema\get_pointer($pointer, 'only_no_additional_properties'),
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

    if (\HH\Lib\C\contains_key($typed, 'defaults')) {
      try {
        $output['defaults'] = DiscardAddititionalPropertiesValidatorPropertiesDefaults::check(
          $typed['defaults'],
          JsonSchema\get_pointer($pointer, 'defaults'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'only_pattern_properties')) {
      try {
        $output['only_pattern_properties'] = DiscardAddititionalPropertiesValidatorPropertiesOnlyPatternProperties::check(
          $typed['only_pattern_properties'],
          JsonSchema\get_pointer($pointer, 'only_pattern_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'single_pattern_property_string')) {
      try {
        $output['single_pattern_property_string'] = DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyString::check(
          $typed['single_pattern_property_string'],
          JsonSchema\get_pointer($pointer, 'single_pattern_property_string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'single_pattern_property_object')) {
      try {
        $output['single_pattern_property_object'] = DiscardAddititionalPropertiesValidatorPropertiesSinglePatternPropertyObject::check(
          $typed['single_pattern_property_object'],
          JsonSchema\get_pointer($pointer, 'single_pattern_property_object'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'pattern_properties_no_additional_properties')) {
      try {
        $output['pattern_properties_no_additional_properties'] = DiscardAddititionalPropertiesValidatorPropertiesPatternPropertiesNoAdditionalProperties::check(
          $typed['pattern_properties_no_additional_properties'],
          JsonSchema\get_pointer($pointer, 'pattern_properties_no_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'properties_and_pattern_properties')) {
      try {
        $output['properties_and_pattern_properties'] = DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternProperties::check(
          $typed['properties_and_pattern_properties'],
          JsonSchema\get_pointer($pointer, 'properties_and_pattern_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'properties_and_pattern_properties_no_additional')) {
      try {
        $output['properties_and_pattern_properties_no_additional'] = DiscardAddititionalPropertiesValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional::check(
          $typed['properties_and_pattern_properties_no_additional'],
          JsonSchema\get_pointer($pointer, 'properties_and_pattern_properties_no_additional'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'nested_object')) {
      try {
        $output['nested_object'] = DiscardAddititionalPropertiesValidatorPropertiesNestedObject::check(
          $typed['nested_object'],
          JsonSchema\get_pointer($pointer, 'nested_object'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'coerce_object')) {
      try {
        $output['coerce_object'] = DiscardAddititionalPropertiesValidatorPropertiesCoerceObject::check(
          $typed['coerce_object'],
          JsonSchema\get_pointer($pointer, 'coerce_object'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'implicit_additional_properties')) {
      try {
        $output['implicit_additional_properties'] = DiscardAddititionalPropertiesValidatorPropertiesImplicitAdditionalProperties::check(
          $typed['implicit_additional_properties'],
          JsonSchema\get_pointer($pointer, 'implicit_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'explicit_additional_properties')) {
      try {
        $output['explicit_additional_properties'] = DiscardAddititionalPropertiesValidatorPropertiesExplicitAdditionalProperties::check(
          $typed['explicit_additional_properties'],
          JsonSchema\get_pointer($pointer, 'explicit_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'no_additional_properties')) {
      try {
        $output['no_additional_properties'] = DiscardAddititionalPropertiesValidatorPropertiesNoAdditionalProperties::check(
          $typed['no_additional_properties'],
          JsonSchema\get_pointer($pointer, 'no_additional_properties'),
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
