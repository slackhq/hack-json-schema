<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<1db056e83d92cf075d897fac2e9d6a39>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorNestedShapesAnyOf0PropertiesFoo = shape(
  ?'baz' => int,
);

type TAnyOfValidatorNestedShapesAnyOf0 = shape(
  'foo' => TAnyOfValidatorNestedShapesAnyOf0PropertiesFoo,
  ...
);

type TAnyOfValidatorNestedShapesAnyOf1PropertiesFoo = shape(
  ?'baz' => string,
  ?'qux' => bool,
);

type TAnyOfValidatorNestedShapesAnyOf1 = shape(
  'foo' => TAnyOfValidatorNestedShapesAnyOf1PropertiesFoo,
  ...
);

type TAnyOfValidatorNestedShapesFooField = shape(
  ?'baz' => arraykey,
  ?'qux' => bool,
);

type TAnyOfValidatorNestedShapes = shape(
  'foo' => TAnyOfValidatorNestedShapesFooField,
  ...
);

final class AnyOfValidatorNestedShapesAnyOf0PropertiesFooPropertiesBaz {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorNestedShapesAnyOf0PropertiesFoo {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'baz',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNestedShapesAnyOf0PropertiesFoo {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'baz')) {
      try {
        $output['baz'] = AnyOfValidatorNestedShapesAnyOf0PropertiesFooPropertiesBaz::check(
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

final class AnyOfValidatorNestedShapesAnyOf0 {

  private static keyset<string> $required = keyset[
    'foo',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNestedShapesAnyOf0 {
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
        $output['foo'] = AnyOfValidatorNestedShapesAnyOf0PropertiesFoo::check(
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

final class AnyOfValidatorNestedShapesAnyOf1PropertiesFooPropertiesBaz {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorNestedShapesAnyOf1PropertiesFooPropertiesQux {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class AnyOfValidatorNestedShapesAnyOf1PropertiesFoo {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'baz',
    'qux',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNestedShapesAnyOf1PropertiesFoo {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'baz')) {
      try {
        $output['baz'] = AnyOfValidatorNestedShapesAnyOf1PropertiesFooPropertiesBaz::check(
          $typed['baz'],
          JsonSchema\get_pointer($pointer, 'baz'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'qux')) {
      try {
        $output['qux'] = AnyOfValidatorNestedShapesAnyOf1PropertiesFooPropertiesQux::check(
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

final class AnyOfValidatorNestedShapesAnyOf1 {

  private static keyset<string> $required = keyset[
    'foo',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNestedShapesAnyOf1 {
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
        $output['foo'] = AnyOfValidatorNestedShapesAnyOf1PropertiesFoo::check(
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

final class AnyOfValidatorNestedShapes
  extends JsonSchema\BaseValidator<TAnyOfValidatorNestedShapes> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorNestedShapes {
    $constraints = vec[
      AnyOfValidatorNestedShapesAnyOf0::check<>,
      AnyOfValidatorNestedShapesAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorNestedShapes {
    return self::check($this->input, $this->pointer);
  }
}
