<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<0c4fdc27f37539f07b7f2f9143483751>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExamplesAllofSchema2AllOfPropertiesXsItemsAllOf1 = shape(
  'qux' => int,
  ...
);

type TExamplesAllofSchema2AllOfPropertiesXsItems = mixed;

type TExamplesAllofSchema2AllOfPropertiesSimpleObjectProp2 = shape(
  'prop_1' => int,
);

type TExamplesAllofSchema2AllOf = shape(
  'baz' => int,
  'xs' => vec<TExamplesAllofSchema2AllOfPropertiesXsItems>,
  'simple_object_prop_1' => int,
  ?'simple_object_prop_2' => TExamplesAllofSchema2AllOfPropertiesSimpleObjectProp2,
  'nickname' => string,
  'bar' => int,
  'foo' => int,
);

type TExamplesAllofSchema2 = TExamplesAllofSchema2AllOf;

final class ExamplesAllofSchema2AllOfPropertiesBaz {

  private static num $devisorForMultipleOf = 3;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMultipleOfConstraint::check(
      $typed,
      self::$devisorForMultipleOf,
      $pointer,
    );
    return $typed;
  }
}

final class ExamplesAllofSchema2AllOfPropertiesXsItemsAllOf1PropertiesQux {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesAllofSchema2AllOfPropertiesXsItemsAllOf1 {

  private static keyset<string> $required = keyset[
    'qux',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesAllofSchema2AllOfPropertiesXsItemsAllOf1 {
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

    if (\HH\Lib\C\contains_key($typed, 'qux')) {
      try {
        $output['qux'] = ExamplesAllofSchema2AllOfPropertiesXsItemsAllOf1PropertiesQux::check(
          $typed['qux'],
          JsonSchema\get_pointer($pointer, 'qux'),
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

final class ExamplesAllofSchema2AllOfPropertiesXsItems {

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesAllofSchema2AllOfPropertiesXsItems {
    $constraints = vec[
      ExamplesAllofSchema1::check<>,
      ExamplesAllofSchema2AllOfPropertiesXsItemsAllOf1::check<>,
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
        'message' => 'failed to match all allowed schemas',
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class ExamplesAllofSchema2AllOfPropertiesXs {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TExamplesAllofSchema2AllOfPropertiesXsItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesAllofSchema2AllOfPropertiesXsItems::check(
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

final class ExamplesAllofSchema2AllOfPropertiesSimpleObjectProp1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesAllofSchema2AllOfPropertiesSimpleObjectProp2PropertiesProp1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesAllofSchema2AllOfPropertiesSimpleObjectProp2 {

  private static keyset<string> $required = keyset[
    'prop_1',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'prop_1',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesAllofSchema2AllOfPropertiesSimpleObjectProp2 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'prop_1')) {
      try {
        $output['prop_1'] = ExamplesAllofSchema2AllOfPropertiesSimpleObjectProp2PropertiesProp1::check(
          $typed['prop_1'],
          JsonSchema\get_pointer($pointer, 'prop_1'),
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

final class ExamplesAllofSchema2AllOfPropertiesBar {

  private static int $maximum = 10;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMaximumConstraint::check(
      $typed,
      self::$maximum,
      $pointer,
    );
    return $typed;
  }
}

final class ExamplesAllofSchema2AllOfPropertiesFoo {

  private static int $minimum = 0;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMinimumConstraint::check(
      $typed,
      self::$minimum,
      $pointer,
    );
    return $typed;
  }
}

final class ExamplesAllofSchema2AllOf {

  private static keyset<string> $required = keyset[
    'baz',
    'xs',
    'nickname',
    'simple_object_prop_1',
    'bar',
    'foo',
  ];
  private static bool $coerce = true;
  private static keyset<string> $properties = keyset[
    'baz',
    'xs',
    'simple_object_prop_1',
    'simple_object_prop_2',
    'nickname',
    'bar',
    'foo',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesAllofSchema2AllOf {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'baz')) {
      try {
        $output['baz'] = ExamplesAllofSchema2AllOfPropertiesBaz::check(
          $typed['baz'],
          JsonSchema\get_pointer($pointer, 'baz'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'xs')) {
      try {
        $output['xs'] = ExamplesAllofSchema2AllOfPropertiesXs::check(
          $typed['xs'],
          JsonSchema\get_pointer($pointer, 'xs'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'simple_object_prop_1')) {
      try {
        $output['simple_object_prop_1'] = ExamplesAllofSchema2AllOfPropertiesSimpleObjectProp1::check(
          $typed['simple_object_prop_1'],
          JsonSchema\get_pointer($pointer, 'simple_object_prop_1'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'simple_object_prop_2')) {
      try {
        $output['simple_object_prop_2'] = ExamplesAllofSchema2AllOfPropertiesSimpleObjectProp2::check(
          $typed['simple_object_prop_2'],
          JsonSchema\get_pointer($pointer, 'simple_object_prop_2'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'nickname')) {
      try {
        $output['nickname'] = ExternalExamplesExternalDefinitionsNickname::check(
          $typed['nickname'],
          JsonSchema\get_pointer($pointer, 'nickname'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'bar')) {
      try {
        $output['bar'] = ExamplesAllofSchema2AllOfPropertiesBar::check(
          $typed['bar'],
          JsonSchema\get_pointer($pointer, 'bar'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = ExamplesAllofSchema2AllOfPropertiesFoo::check(
          $typed['foo'],
          JsonSchema\get_pointer($pointer, 'foo'),
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

final class ExamplesAllofSchema2
  extends JsonSchema\BaseValidator<TExamplesAllofSchema2> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesAllofSchema2 {
    return ExamplesAllofSchema2AllOf::check($input, $pointer);
  }

  <<__Override>>
  protected function process(): TExamplesAllofSchema2 {
    return self::check($this->input, $this->pointer);
  }
}
