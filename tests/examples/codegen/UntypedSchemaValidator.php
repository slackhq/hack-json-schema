<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<fc81ca3326a9d333b791d19ae91a05c6>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TUntypedSchemaValidatorPropertiesAllOf = mixed;

type TUntypedSchemaValidatorPropertiesAnyOf = mixed;

type TUntypedSchemaValidatorPropertiesAllOfPassThrough = mixed;

type TUntypedSchemaValidatorPropertiesAllOfPassThroughSecond = mixed;

type TUntypedSchemaValidatorPropertiesAllOfCoerceAllOf0 = dict<string, mixed>;

type TUntypedSchemaValidatorPropertiesAllOfCoerceAllOf1 = shape(
  ?'property' => string,
  ...
);

type TUntypedSchemaValidatorPropertiesAllOfCoerce = mixed;

type TUntypedSchemaValidatorPropertiesAllOfDefaultAllOf0 = shape(
  ?'property' => string,
  ...
);

type TUntypedSchemaValidatorPropertiesAllOfDefaultAllOf1 = shape(
  ?'numerical_property' => num,
  ...
);

type TUntypedSchemaValidatorPropertiesAllOfDefault = mixed;

type TUntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf0 = shape(
  ?'property' => string,
  ...
);

type TUntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf1 = shape(
  ?'property' => string,
  ...
);

type TUntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWins = mixed;

type TUntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirst = shape(
  'type' => string,
  ?'string' => string,
);

type TUntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecond = shape(
  'type' => string,
  ?'integer' => int,
);

type TUntypedSchemaValidatorPropertiesAnyOfOptimizedEnum = mixed;

type TUntypedSchemaValidator = shape(
  ?'all_of' => TUntypedSchemaValidatorPropertiesAllOf,
  ?'any_of' => TUntypedSchemaValidatorPropertiesAnyOf,
  ?'all_of_pass_through' => TUntypedSchemaValidatorPropertiesAllOfPassThrough,
  ?'all_of_pass_through_second' => TUntypedSchemaValidatorPropertiesAllOfPassThroughSecond,
  ?'all_of_coerce' => TUntypedSchemaValidatorPropertiesAllOfCoerce,
  ?'all_of_default' => TUntypedSchemaValidatorPropertiesAllOfDefault,
  ?'all_of_default_first_schema_wins' => TUntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWins,
  ?'any_of_optimized_enum' => TUntypedSchemaValidatorPropertiesAnyOfOptimizedEnum,
  ...
);

final class UntypedSchemaValidatorPropertiesAllOfAllOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfAllOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOf {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOf {
    $constraints = vec[
      class_meth(UntypedSchemaValidatorPropertiesAllOfAllOf0::class, 'check'),
      class_meth(UntypedSchemaValidatorPropertiesAllOfAllOf1::class, 'check'),
    ];

    $failed_any = false;
    $errors = vec[
    ];
    $output = $input;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($output, $pointer);
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
        $failed_any = true;
      }
    }

    if ($failed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ALL_OF,
        ),
        'message' => "failed to match all allowed schemas",
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOfAnyOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOfAnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOf {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAnyOf {
    $constraints = vec[
      class_meth(UntypedSchemaValidatorPropertiesAnyOfAnyOf0::class, 'check'),
      class_meth(UntypedSchemaValidatorPropertiesAnyOfAnyOf1::class, 'check'),
    ];
    $errors = vec[
    ];

    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($input, $pointer);
        return $output;
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $error = shape(
      'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
      'constraint' => shape(
        'type' => JsonSchema\FieldErrorConstraint::ANY_OF,
      ),
      'message' => "failed to match any allowed schemas",
    );

    $output_errors = vec[$error];
    $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
    throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
  }
}

final class UntypedSchemaValidatorPropertiesAllOfPassThroughAllOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $sanitize_string =
      fun('\Slack\Hack\JsonSchema\Tests\_untyped_schema_validator_test_uniline');
    $typed = $sanitize_string($typed);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfPassThroughAllOf1 {

  private static int $minLength = 1;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $length = \mb_strlen($typed);
    Constraints\StringMinLengthConstraint::check(
      $length,
      self::$minLength,
      $pointer,
    );
    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfPassThrough {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfPassThrough {
    $constraints = vec[
      class_meth(UntypedSchemaValidatorPropertiesAllOfPassThroughAllOf0::class, 'check'),
      class_meth(UntypedSchemaValidatorPropertiesAllOfPassThroughAllOf1::class, 'check'),
    ];

    $failed_any = false;
    $errors = vec[
    ];
    $output = $input;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($output, $pointer);
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
        $failed_any = true;
      }
    }

    if ($failed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ALL_OF,
        ),
        'message' => "failed to match all allowed schemas",
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfPassThroughSecondAllOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $sanitize_string =
      fun('\Slack\Hack\JsonSchema\Tests\_untyped_schema_validator_test_multiline');
    $typed = $sanitize_string($typed);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfPassThroughSecondAllOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $sanitize_string =
      fun('\Slack\Hack\JsonSchema\Tests\_untyped_schema_validator_test_uniline');
    $typed = $sanitize_string($typed);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfPassThroughSecond {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfPassThroughSecond {
    $constraints = vec[
      class_meth(UntypedSchemaValidatorPropertiesAllOfPassThroughSecondAllOf0::class, 'check'),
      class_meth(UntypedSchemaValidatorPropertiesAllOfPassThroughSecondAllOf1::class, 'check'),
    ];

    $failed_any = false;
    $errors = vec[
    ];
    $output = $input;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($output, $pointer);
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
        $failed_any = true;
      }
    }

    if ($failed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ALL_OF,
        ),
        'message' => "failed to match all allowed schemas",
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfCoerceAllOf0 {

  private static bool $coerce = true;

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfCoerceAllOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfCoerceAllOf1PropertiesProperty {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfCoerceAllOf1 {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfCoerceAllOf1 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'property')) {
      try {
        $output['property'] = UntypedSchemaValidatorPropertiesAllOfCoerceAllOf1PropertiesProperty::check(
          $typed['property'],
          JsonSchema\get_pointer($pointer, 'property'),
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

final class UntypedSchemaValidatorPropertiesAllOfCoerce {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfCoerce {
    $constraints = vec[
      class_meth(UntypedSchemaValidatorPropertiesAllOfCoerceAllOf0::class, 'check'),
      class_meth(UntypedSchemaValidatorPropertiesAllOfCoerceAllOf1::class, 'check'),
    ];

    $failed_any = false;
    $errors = vec[
    ];
    $output = $input;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($output, $pointer);
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
        $failed_any = true;
      }
    }

    if ($failed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ALL_OF,
        ),
        'message' => "failed to match all allowed schemas",
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfDefaultAllOf0PropertiesProperty {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfDefaultAllOf0 {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfDefaultAllOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $defaults = dict[
      'property' => 'default',
    ];
    $typed = \HH\Lib\Dict\merge($defaults, $typed);


    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'property')) {
      try {
        $output['property'] = UntypedSchemaValidatorPropertiesAllOfDefaultAllOf0PropertiesProperty::check(
          $typed['property'],
          JsonSchema\get_pointer($pointer, 'property'),
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

final class UntypedSchemaValidatorPropertiesAllOfDefaultAllOf1PropertiesNumericalProperty {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfDefaultAllOf1 {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfDefaultAllOf1 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $defaults = dict[
      'numerical_property' => 0,
    ];
    $typed = \HH\Lib\Dict\merge($defaults, $typed);


    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'numerical_property')) {
      try {
        $output['numerical_property'] = UntypedSchemaValidatorPropertiesAllOfDefaultAllOf1PropertiesNumericalProperty::check(
          $typed['numerical_property'],
          JsonSchema\get_pointer($pointer, 'numerical_property'),
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

final class UntypedSchemaValidatorPropertiesAllOfDefault {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfDefault {
    $constraints = vec[
      class_meth(UntypedSchemaValidatorPropertiesAllOfDefaultAllOf0::class, 'check'),
      class_meth(UntypedSchemaValidatorPropertiesAllOfDefaultAllOf1::class, 'check'),
    ];

    $failed_any = false;
    $errors = vec[
    ];
    $output = $input;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($output, $pointer);
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
        $failed_any = true;
      }
    }

    if ($failed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ALL_OF,
        ),
        'message' => "failed to match all allowed schemas",
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf0PropertiesProperty {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf0 {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $defaults = dict[
      'property' => 'actual_default',
    ];
    $typed = \HH\Lib\Dict\merge($defaults, $typed);


    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'property')) {
      try {
        $output['property'] = UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf0PropertiesProperty::check(
          $typed['property'],
          JsonSchema\get_pointer($pointer, 'property'),
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

final class UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf1PropertiesProperty {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf1 {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf1 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $defaults = dict[
      'property' => 'not_default',
    ];
    $typed = \HH\Lib\Dict\merge($defaults, $typed);


    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'property')) {
      try {
        $output['property'] = UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf1PropertiesProperty::check(
          $typed['property'],
          JsonSchema\get_pointer($pointer, 'property'),
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

final class UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWins {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWins {
    $constraints = vec[
      class_meth(UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf0::class, 'check'),
      class_meth(UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWinsAllOf1::class, 'check'),
    ];

    $failed_any = false;
    $errors = vec[
    ];
    $output = $input;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($output, $pointer);
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
        $failed_any = true;
      }
    }

    if ($failed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ALL_OF,
        ),
        'message' => "failed to match all allowed schemas",
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirstPropertiesType {

  private static vec<mixed> $enum = vec[
    'first',
  ];
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\EnumConstraint::check($typed, self::$enum, $pointer);
    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirstPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirst {

  private static keyset<string> $required = keyset[
    'type',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'type',
    'string',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirst {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'type')) {
      try {
        $output['type'] = UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirstPropertiesType::check(
          $typed['type'],
          JsonSchema\get_pointer($pointer, 'type'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'string')) {
      try {
        $output['string'] = UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirstPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
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

final class UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecondPropertiesType {

  private static vec<mixed> $enum = vec[
    'second',
  ];
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\EnumConstraint::check($typed, self::$enum, $pointer);
    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecondPropertiesInteger {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecond {

  private static keyset<string> $required = keyset[
    'type',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'type',
    'integer',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecond {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'type')) {
      try {
        $output['type'] = UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecondPropertiesType::check(
          $typed['type'],
          JsonSchema\get_pointer($pointer, 'type'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'integer')) {
      try {
        $output['integer'] = UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecondPropertiesInteger::check(
          $typed['integer'],
          JsonSchema\get_pointer($pointer, 'integer'),
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

final class UntypedSchemaValidatorPropertiesAnyOfOptimizedEnum {

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidatorPropertiesAnyOfOptimizedEnum {
    $key = 'type';
    $typed = Constraints\ObjectConstraint::check($input, $pointer, false);

    Constraints\ObjectRequiredConstraint::check($typed, keyset[$key], $pointer);
    $type_name = ($typed[$key] ?? null) as nonnull;
    $field_pointer = JsonSchema\get_pointer($pointer, $key);
    $type_name =
      Constraints\StringConstraint::check($type_name, $field_pointer, false);

    $types = dict[
      'first' =>
        class_meth(UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesFirst::class, 'check'),
      'second' =>
        class_meth(UntypedSchemaValidatorPropertiesAnyOfOptimizedEnumAnyOfTypesSecond::class, 'check'),
    ];

    $constraint = $types[$type_name] ?? null;
    if ($constraint === null) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ENUM,
          'expected' => \HH\Lib\Vec\keys($types),
          'got' => $type_name,
        ),
        'message' => "unsupported type: {$type_name}",
      );
      throw new JsonSchema\InvalidFieldException($field_pointer, vec[$error]);
    }

    return $constraint($typed, $pointer);
  }
}

final class UntypedSchemaValidator
  extends JsonSchema\BaseValidator<TUntypedSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TUntypedSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'all_of')) {
      try {
        $output['all_of'] = UntypedSchemaValidatorPropertiesAllOf::check(
          $typed['all_of'],
          JsonSchema\get_pointer($pointer, 'all_of'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'any_of')) {
      try {
        $output['any_of'] = UntypedSchemaValidatorPropertiesAnyOf::check(
          $typed['any_of'],
          JsonSchema\get_pointer($pointer, 'any_of'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'all_of_pass_through')) {
      try {
        $output['all_of_pass_through'] = UntypedSchemaValidatorPropertiesAllOfPassThrough::check(
          $typed['all_of_pass_through'],
          JsonSchema\get_pointer($pointer, 'all_of_pass_through'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'all_of_pass_through_second')) {
      try {
        $output['all_of_pass_through_second'] = UntypedSchemaValidatorPropertiesAllOfPassThroughSecond::check(
          $typed['all_of_pass_through_second'],
          JsonSchema\get_pointer($pointer, 'all_of_pass_through_second'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'all_of_coerce')) {
      try {
        $output['all_of_coerce'] = UntypedSchemaValidatorPropertiesAllOfCoerce::check(
          $typed['all_of_coerce'],
          JsonSchema\get_pointer($pointer, 'all_of_coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'all_of_default')) {
      try {
        $output['all_of_default'] = UntypedSchemaValidatorPropertiesAllOfDefault::check(
          $typed['all_of_default'],
          JsonSchema\get_pointer($pointer, 'all_of_default'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'all_of_default_first_schema_wins')) {
      try {
        $output['all_of_default_first_schema_wins'] = UntypedSchemaValidatorPropertiesAllOfDefaultFirstSchemaWins::check(
          $typed['all_of_default_first_schema_wins'],
          JsonSchema\get_pointer($pointer, 'all_of_default_first_schema_wins'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'any_of_optimized_enum')) {
      try {
        $output['any_of_optimized_enum'] = UntypedSchemaValidatorPropertiesAnyOfOptimizedEnum::check(
          $typed['any_of_optimized_enum'],
          JsonSchema\get_pointer($pointer, 'any_of_optimized_enum'),
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
  final protected function process(): TUntypedSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
