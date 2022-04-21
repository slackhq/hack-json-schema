<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<2ed2cd3d553b48d57812b80f98e5a62d>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorNullableNestedShapesAnyOf0PropertiesFooAnyOf0 = shape(
  ?'baz' => int,
);

type TAnyOfValidatorNullableNestedShapesAnyOf0PropertiesFoo = ?TAnyOfValidatorNullableNestedShapesAnyOf0PropertiesFooAnyOf0;

type TAnyOfValidatorNullableNestedShapesAnyOf0 = shape(
  'foo' => TAnyOfValidatorNullableNestedShapesAnyOf0PropertiesFoo,
  ...
);

type TAnyOfValidatorNullableNestedShapesAnyOf1PropertiesFoo = shape(
  ?'baz' => string,
  ?'qux' => bool,
);

type TAnyOfValidatorNullableNestedShapesAnyOf1 = shape(
  'foo' => TAnyOfValidatorNullableNestedShapesAnyOf1PropertiesFoo,
  ...
);

type TAnyOfValidatorNullableNestedShapesFooFieldNonnull = shape(
  ?'baz' => arraykey,
  ?'qux' => bool,
);

type TAnyOfValidatorNullableNestedShapes = shape(
  'foo' => ?TAnyOfValidatorNullableNestedShapesFooFieldNonnull,
  ...
);

final class AnyOfValidatorNullableNestedShapesAnyOf0PropertiesFooAnyOf0PropertiesBaz {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorNullableNestedShapesAnyOf0PropertiesFooAnyOf0 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'baz',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableNestedShapesAnyOf0PropertiesFooAnyOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'baz')) {
      try {
        $output['baz'] = AnyOfValidatorNullableNestedShapesAnyOf0PropertiesFooAnyOf0PropertiesBaz::check(
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

final class AnyOfValidatorNullableNestedShapesAnyOf0PropertiesFoo {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableNestedShapesAnyOf0PropertiesFoo {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      AnyOfValidatorNullableNestedShapesAnyOf0PropertiesFooAnyOf0::check<>,
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
}

final class AnyOfValidatorNullableNestedShapesAnyOf0 {

  private static keyset<string> $required = keyset[
    'foo',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableNestedShapesAnyOf0 {
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

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = AnyOfValidatorNullableNestedShapesAnyOf0PropertiesFoo::check(
          $typed['foo'],
          JsonSchema\get_pointer($pointer, 'foo'),
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

final class AnyOfValidatorNullableNestedShapesAnyOf1PropertiesFooPropertiesBaz {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorNullableNestedShapesAnyOf1PropertiesFooPropertiesQux {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class AnyOfValidatorNullableNestedShapesAnyOf1PropertiesFoo {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'baz',
    'qux',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableNestedShapesAnyOf1PropertiesFoo {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'baz')) {
      try {
        $output['baz'] = AnyOfValidatorNullableNestedShapesAnyOf1PropertiesFooPropertiesBaz::check(
          $typed['baz'],
          JsonSchema\get_pointer($pointer, 'baz'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'qux')) {
      try {
        $output['qux'] = AnyOfValidatorNullableNestedShapesAnyOf1PropertiesFooPropertiesQux::check(
          $typed['qux'],
          JsonSchema\get_pointer($pointer, 'qux'),
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

final class AnyOfValidatorNullableNestedShapesAnyOf1 {

  private static keyset<string> $required = keyset[
    'foo',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableNestedShapesAnyOf1 {
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

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = AnyOfValidatorNullableNestedShapesAnyOf1PropertiesFoo::check(
          $typed['foo'],
          JsonSchema\get_pointer($pointer, 'foo'),
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

final class AnyOfValidatorNullableNestedShapes
  extends JsonSchema\BaseValidator<TAnyOfValidatorNullableNestedShapes> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNullableNestedShapes {
    $constraints = vec[
      AnyOfValidatorNullableNestedShapesAnyOf0::check<>,
      AnyOfValidatorNullableNestedShapesAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorNullableNestedShapes {
    return self::check($this->input, $this->pointer);
  }
}
