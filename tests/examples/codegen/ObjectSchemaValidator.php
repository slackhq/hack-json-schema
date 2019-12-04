<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<83c988c26df133b35ff3d28a6ed1521c>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TObjectSchemaValidatorPropertiesOnlyAdditionalProperties = dict<string, mixed>;

type TObjectSchemaValidatorPropertiesOnlyNoAdditionalProperties = dict<string, mixed>;

type TObjectSchemaValidatorPropertiesOnlyProperties = shape(
  ?'string' => string,
  ?'number' => num,
  'required_string' => string,
);

type TObjectSchemaValidatorPropertiesOnlyPatternProperties = dict<string, mixed>;

type TObjectSchemaValidatorPropertiesSinglePatternPropertyString = dict<string, string>;

type TObjectSchemaValidatorPropertiesSinglePatternPropertyObjectPatternProperties0 = shape(
  'sample' => string,
  ...
);

type TObjectSchemaValidatorPropertiesSinglePatternPropertyObject = dict<string, TObjectSchemaValidatorPropertiesSinglePatternPropertyObjectPatternProperties0>;

type TObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalProperties = dict<string, mixed>;

type TObjectSchemaValidatorPropertiesPropertiesAndPatternProperties = shape(
  ?'string' => string,
  ...
);

type TObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional = shape(
  ?'string' => string,
);

type TObjectSchemaValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond = shape(
  ?'last' => string,
  ...
);

type TObjectSchemaValidatorPropertiesNestedObjectPropertiesFirst = shape(
  ?'second' => TObjectSchemaValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond,
  ...
);

type TObjectSchemaValidatorPropertiesNestedObject = shape(
  ?'first' => TObjectSchemaValidatorPropertiesNestedObjectPropertiesFirst,
  ...
);

type TObjectSchemaValidatorPropertiesCoerceObject = shape(
  ?'first' => string,
  ?'second' => num,
  ...
);

type TObjectSchemaValidatorPropertiesImplicitAdditionalProperties = shape(
  ?'first' => string,
  ...
);

type TObjectSchemaValidatorPropertiesExplicitAdditionalProperties = shape(
  ?'first' => string,
  ...
);

type TObjectSchemaValidatorPropertiesNoAdditionalProperties = shape(
  ?'first' => string,
);

type TObjectSchemaValidatorPropertiesAdditionalPropertiesArray = dict<string, mixed>;

type TObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalProperties = dict<string, mixed>;

type TObjectSchemaValidatorPropertiesAdditionalPropertiesRef = dict<string, mixed>;

type TObjectSchemaValidator = shape(
  ?'only_additional_properties' => TObjectSchemaValidatorPropertiesOnlyAdditionalProperties,
  ?'only_no_additional_properties' => TObjectSchemaValidatorPropertiesOnlyNoAdditionalProperties,
  ?'only_properties' => TObjectSchemaValidatorPropertiesOnlyProperties,
  ?'only_pattern_properties' => TObjectSchemaValidatorPropertiesOnlyPatternProperties,
  ?'single_pattern_property_string' => TObjectSchemaValidatorPropertiesSinglePatternPropertyString,
  ?'single_pattern_property_object' => TObjectSchemaValidatorPropertiesSinglePatternPropertyObject,
  ?'pattern_properties_no_additional_properties' => TObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalProperties,
  ?'properties_and_pattern_properties' => TObjectSchemaValidatorPropertiesPropertiesAndPatternProperties,
  ?'properties_and_pattern_properties_no_additional' => TObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional,
  ?'nested_object' => TObjectSchemaValidatorPropertiesNestedObject,
  ?'coerce_object' => TObjectSchemaValidatorPropertiesCoerceObject,
  ?'implicit_additional_properties' => TObjectSchemaValidatorPropertiesImplicitAdditionalProperties,
  ?'explicit_additional_properties' => TObjectSchemaValidatorPropertiesExplicitAdditionalProperties,
  ?'no_additional_properties' => TObjectSchemaValidatorPropertiesNoAdditionalProperties,
  ?'additional_properties_array' => TObjectSchemaValidatorPropertiesAdditionalPropertiesArray,
  ?'additional_properties_ref' => TObjectSchemaValidatorPropertiesAdditionalPropertiesRef,
  ...
);

final class ObjectSchemaValidatorPropertiesOnlyAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesOnlyAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesOnlyNoAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesOnlyNoAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
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

final class ObjectSchemaValidatorPropertiesOnlyPropertiesPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesOnlyPropertiesPropertiesNumber {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesOnlyPropertiesPropertiesRequiredString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesOnlyProperties {

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
  ): TObjectSchemaValidatorPropertiesOnlyProperties {
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
        $output['string'] = ObjectSchemaValidatorPropertiesOnlyPropertiesPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number')) {
      try {
        $output['number'] = ObjectSchemaValidatorPropertiesOnlyPropertiesPropertiesNumber::check(
          $typed['number'],
          JsonSchema\get_pointer($pointer, 'number'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'required_string')) {
      try {
        $output['required_string'] = ObjectSchemaValidatorPropertiesOnlyPropertiesPropertiesRequiredString::check(
          $typed['required_string'],
          JsonSchema\get_pointer($pointer, 'required_string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      if (\HH\Lib\C\contains_key(self::$properties, $key)) {
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

final class ObjectSchemaValidatorPropertiesOnlyPatternPropertiesPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesOnlyPatternPropertiesPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesOnlyPatternProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesOnlyPatternProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        class_meth(ObjectSchemaValidatorPropertiesOnlyPatternPropertiesPatternProperties0::class, 'check'),
      '^I_' =>
        class_meth(ObjectSchemaValidatorPropertiesOnlyPatternPropertiesPatternProperties1::class, 'check'),
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

final class ObjectSchemaValidatorPropertiesSinglePatternPropertyStringPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesSinglePatternPropertyString {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesSinglePatternPropertyString {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        class_meth(ObjectSchemaValidatorPropertiesSinglePatternPropertyStringPatternProperties0::class, 'check'),
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

final class ObjectSchemaValidatorPropertiesSinglePatternPropertyObjectPatternProperties0PropertiesSample {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesSinglePatternPropertyObjectPatternProperties0 {

  private static keyset<string> $required = keyset[
    'sample',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesSinglePatternPropertyObjectPatternProperties0 {
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
        $output['sample'] = ObjectSchemaValidatorPropertiesSinglePatternPropertyObjectPatternProperties0PropertiesSample::check(
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

final class ObjectSchemaValidatorPropertiesSinglePatternPropertyObject {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesSinglePatternPropertyObject {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        class_meth(ObjectSchemaValidatorPropertiesSinglePatternPropertyObjectPatternProperties0::class, 'check'),
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

final class ObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    $patterns = dict[
      '^S_' =>
        class_meth(ObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties0::class, 'check'),
      '^I_' =>
        class_meth(ObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalPropertiesPatternProperties1::class, 'check'),
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

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternProperties {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'string',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesPropertiesAndPatternProperties {
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
        $output['string'] = ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $patterns = dict[
      '^S_' =>
        class_meth(ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties0::class, 'check'),
      '^I_' =>
        class_meth(ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesPatternProperties1::class, 'check'),
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

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'string',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'string')) {
      try {
        $output['string'] = ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $patterns = dict[
      '^S_' =>
        class_meth(ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties0::class, 'check'),
      '^I_' =>
        class_meth(ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditionalPatternProperties1::class, 'check'),
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

final class ObjectSchemaValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecondPropertiesLast {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond {
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
        $output['last'] = ObjectSchemaValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecondPropertiesLast::check(
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

final class ObjectSchemaValidatorPropertiesNestedObjectPropertiesFirst {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesNestedObjectPropertiesFirst {
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
        $output['second'] = ObjectSchemaValidatorPropertiesNestedObjectPropertiesFirstPropertiesSecond::check(
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

final class ObjectSchemaValidatorPropertiesNestedObject {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesNestedObject {
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
        $output['first'] = ObjectSchemaValidatorPropertiesNestedObjectPropertiesFirst::check(
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

final class ObjectSchemaValidatorPropertiesCoerceObjectPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesCoerceObjectPropertiesSecond {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesCoerceObject {

  private static bool $coerce = true;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesCoerceObject {
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
        $output['first'] = ObjectSchemaValidatorPropertiesCoerceObjectPropertiesFirst::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'second')) {
      try {
        $output['second'] = ObjectSchemaValidatorPropertiesCoerceObjectPropertiesSecond::check(
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

final class ObjectSchemaValidatorPropertiesImplicitAdditionalPropertiesPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesImplicitAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesImplicitAdditionalProperties {
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
        $output['first'] = ObjectSchemaValidatorPropertiesImplicitAdditionalPropertiesPropertiesFirst::check(
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

final class ObjectSchemaValidatorPropertiesExplicitAdditionalPropertiesPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesExplicitAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesExplicitAdditionalProperties {
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
        $output['first'] = ObjectSchemaValidatorPropertiesExplicitAdditionalPropertiesPropertiesFirst::check(
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

final class ObjectSchemaValidatorPropertiesNoAdditionalPropertiesPropertiesFirst {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesNoAdditionalProperties {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'first',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesNoAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = ObjectSchemaValidatorPropertiesNoAdditionalPropertiesPropertiesFirst::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      if (\HH\Lib\C\contains_key(self::$properties, $key)) {
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

final class ObjectSchemaValidatorPropertiesAdditionalPropertiesArrayAdditionalPropertiesItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesAdditionalPropertiesArrayAdditionalProperties {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ObjectSchemaValidatorPropertiesAdditionalPropertiesArrayAdditionalPropertiesItems::check(
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

final class ObjectSchemaValidatorPropertiesAdditionalPropertiesArray {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesAdditionalPropertiesArray {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      try {
        $output[$key] = ObjectSchemaValidatorPropertiesAdditionalPropertiesArrayAdditionalProperties::check(
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

final class ObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalPropertiesItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalProperties {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalPropertiesItems::check(
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

final class ObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalProperties {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalProperties {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      try {
        $output[$key] = ObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalPropertiesAdditionalProperties::check(
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

final class ObjectSchemaValidatorPropertiesAdditionalPropertiesRef {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidatorPropertiesAdditionalPropertiesRef {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      try {
        $output[$key] = ObjectSchemaValidatorPropertiesAdditionalPropertiesRefAdditionalProperties::check(
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

final class ObjectSchemaValidator
  extends JsonSchema\BaseValidator<TObjectSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TObjectSchemaValidator {
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
        $output['only_additional_properties'] = ObjectSchemaValidatorPropertiesOnlyAdditionalProperties::check(
          $typed['only_additional_properties'],
          JsonSchema\get_pointer($pointer, 'only_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'only_no_additional_properties')) {
      try {
        $output['only_no_additional_properties'] = ObjectSchemaValidatorPropertiesOnlyNoAdditionalProperties::check(
          $typed['only_no_additional_properties'],
          JsonSchema\get_pointer($pointer, 'only_no_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'only_properties')) {
      try {
        $output['only_properties'] = ObjectSchemaValidatorPropertiesOnlyProperties::check(
          $typed['only_properties'],
          JsonSchema\get_pointer($pointer, 'only_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'only_pattern_properties')) {
      try {
        $output['only_pattern_properties'] = ObjectSchemaValidatorPropertiesOnlyPatternProperties::check(
          $typed['only_pattern_properties'],
          JsonSchema\get_pointer($pointer, 'only_pattern_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'single_pattern_property_string')) {
      try {
        $output['single_pattern_property_string'] = ObjectSchemaValidatorPropertiesSinglePatternPropertyString::check(
          $typed['single_pattern_property_string'],
          JsonSchema\get_pointer($pointer, 'single_pattern_property_string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'single_pattern_property_object')) {
      try {
        $output['single_pattern_property_object'] = ObjectSchemaValidatorPropertiesSinglePatternPropertyObject::check(
          $typed['single_pattern_property_object'],
          JsonSchema\get_pointer($pointer, 'single_pattern_property_object'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'pattern_properties_no_additional_properties')) {
      try {
        $output['pattern_properties_no_additional_properties'] = ObjectSchemaValidatorPropertiesPatternPropertiesNoAdditionalProperties::check(
          $typed['pattern_properties_no_additional_properties'],
          JsonSchema\get_pointer($pointer, 'pattern_properties_no_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'properties_and_pattern_properties')) {
      try {
        $output['properties_and_pattern_properties'] = ObjectSchemaValidatorPropertiesPropertiesAndPatternProperties::check(
          $typed['properties_and_pattern_properties'],
          JsonSchema\get_pointer($pointer, 'properties_and_pattern_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'properties_and_pattern_properties_no_additional')) {
      try {
        $output['properties_and_pattern_properties_no_additional'] = ObjectSchemaValidatorPropertiesPropertiesAndPatternPropertiesNoAdditional::check(
          $typed['properties_and_pattern_properties_no_additional'],
          JsonSchema\get_pointer($pointer, 'properties_and_pattern_properties_no_additional'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'nested_object')) {
      try {
        $output['nested_object'] = ObjectSchemaValidatorPropertiesNestedObject::check(
          $typed['nested_object'],
          JsonSchema\get_pointer($pointer, 'nested_object'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'coerce_object')) {
      try {
        $output['coerce_object'] = ObjectSchemaValidatorPropertiesCoerceObject::check(
          $typed['coerce_object'],
          JsonSchema\get_pointer($pointer, 'coerce_object'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'implicit_additional_properties')) {
      try {
        $output['implicit_additional_properties'] = ObjectSchemaValidatorPropertiesImplicitAdditionalProperties::check(
          $typed['implicit_additional_properties'],
          JsonSchema\get_pointer($pointer, 'implicit_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'explicit_additional_properties')) {
      try {
        $output['explicit_additional_properties'] = ObjectSchemaValidatorPropertiesExplicitAdditionalProperties::check(
          $typed['explicit_additional_properties'],
          JsonSchema\get_pointer($pointer, 'explicit_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'no_additional_properties')) {
      try {
        $output['no_additional_properties'] = ObjectSchemaValidatorPropertiesNoAdditionalProperties::check(
          $typed['no_additional_properties'],
          JsonSchema\get_pointer($pointer, 'no_additional_properties'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'additional_properties_array')) {
      try {
        $output['additional_properties_array'] = ObjectSchemaValidatorPropertiesAdditionalPropertiesArray::check(
          $typed['additional_properties_array'],
          JsonSchema\get_pointer($pointer, 'additional_properties_array'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'additional_properties_ref')) {
      try {
        $output['additional_properties_ref'] = ObjectSchemaValidatorPropertiesAdditionalPropertiesRef::check(
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
  final protected function process(): TObjectSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
