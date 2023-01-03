<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<35bb5ed6422d1d0ef09f4b4a15a049dc>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorManyShapesAnyOf0 = shape(
  'foo' => int,
);

type TAnyOfValidatorManyShapesAnyOf1 = shape(
  'bar' => string,
);

type TAnyOfValidatorManyShapesAnyOf2 = shape(
  'baz' => bool,
);

type TAnyOfValidatorManyShapesAnyOf3 = shape(
  ?'foo' => null,
);

type TAnyOfValidatorManyShapes = shape(
  ?'foo' => ?int,
  ?'bar' => string,
  ?'baz' => bool,
);

final class AnyOfValidatorManyShapesAnyOf0PropertiesFoo {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorManyShapesAnyOf0 {

  private static keyset<string> $required = keyset[
    'foo',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'foo',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorManyShapesAnyOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = AnyOfValidatorManyShapesAnyOf0PropertiesFoo::check(
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

final class AnyOfValidatorManyShapesAnyOf1PropertiesBar {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorManyShapesAnyOf1 {

  private static keyset<string> $required = keyset[
    'bar',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'bar',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorManyShapesAnyOf1 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'bar')) {
      try {
        $output['bar'] = AnyOfValidatorManyShapesAnyOf1PropertiesBar::check(
          $typed['bar'],
          JsonSchema\get_pointer($pointer, 'bar'),
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

final class AnyOfValidatorManyShapesAnyOf2PropertiesBaz {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class AnyOfValidatorManyShapesAnyOf2 {

  private static keyset<string> $required = keyset[
    'baz',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'baz',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorManyShapesAnyOf2 {
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
        $output['baz'] = AnyOfValidatorManyShapesAnyOf2PropertiesBaz::check(
          $typed['baz'],
          JsonSchema\get_pointer($pointer, 'baz'),
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

final class AnyOfValidatorManyShapesAnyOf3PropertiesFoo {

  public static function check(mixed $input, string $pointer): null {
    $typed = Constraints\NullConstraint::check($input, $pointer);

    return $typed;
  }
}

final class AnyOfValidatorManyShapesAnyOf3 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'foo',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorManyShapesAnyOf3 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = AnyOfValidatorManyShapesAnyOf3PropertiesFoo::check(
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

final class AnyOfValidatorManyShapes
  extends JsonSchema\BaseValidator<TAnyOfValidatorManyShapes> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorManyShapes {
    $constraints = vec[
      AnyOfValidatorManyShapesAnyOf0::check<>,
      AnyOfValidatorManyShapesAnyOf1::check<>,
      AnyOfValidatorManyShapesAnyOf2::check<>,
      AnyOfValidatorManyShapesAnyOf3::check<>,
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
      'message' => 'failed to match any allowed schemas',
    );

    $output_errors = vec[$error];
    $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
    throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
  }

  <<__Override>>
  protected function process(): TAnyOfValidatorManyShapes {
    return self::check($this->input, $this->pointer);
  }
}
