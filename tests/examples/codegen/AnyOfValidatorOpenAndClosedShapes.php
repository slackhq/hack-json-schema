<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<a6f8737bfd59473bc321386ea4f3546d>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorOpenAndClosedShapesAnyOf0 = shape(
  ?'foo' => int,
  'bar' => vec<int>,
  ...
);

type TAnyOfValidatorOpenAndClosedShapesAnyOf1 = shape(
  ?'foo' => string,
  ?'baz' => bool,
);

type TAnyOfValidatorOpenAndClosedShapes = shape(
  ?'foo' => arraykey,
  ?'bar' => vec<int>,
  ...
);

final class AnyOfValidatorOpenAndClosedShapesAnyOf0PropertiesFoo {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorOpenAndClosedShapesAnyOf0PropertiesBarItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorOpenAndClosedShapesAnyOf0PropertiesBar {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<int> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = AnyOfValidatorOpenAndClosedShapesAnyOf0PropertiesBarItems::check(
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

final class AnyOfValidatorOpenAndClosedShapesAnyOf0 {

  private static keyset<string> $required = keyset[
    'bar',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorOpenAndClosedShapesAnyOf0 {
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
        $output['foo'] = AnyOfValidatorOpenAndClosedShapesAnyOf0PropertiesFoo::check(
          $typed['foo'],
          JsonSchema\get_pointer($pointer, 'foo'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'bar')) {
      try {
        $output['bar'] = AnyOfValidatorOpenAndClosedShapesAnyOf0PropertiesBar::check(
          $typed['bar'],
          JsonSchema\get_pointer($pointer, 'bar'),
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

final class AnyOfValidatorOpenAndClosedShapesAnyOf1PropertiesFoo {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorOpenAndClosedShapesAnyOf1PropertiesBaz {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class AnyOfValidatorOpenAndClosedShapesAnyOf1 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'foo',
    'baz',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorOpenAndClosedShapesAnyOf1 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = AnyOfValidatorOpenAndClosedShapesAnyOf1PropertiesFoo::check(
          $typed['foo'],
          JsonSchema\get_pointer($pointer, 'foo'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'baz')) {
      try {
        $output['baz'] = AnyOfValidatorOpenAndClosedShapesAnyOf1PropertiesBaz::check(
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

final class AnyOfValidatorOpenAndClosedShapes
  extends JsonSchema\BaseValidator<TAnyOfValidatorOpenAndClosedShapes> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorOpenAndClosedShapes {
    $constraints = vec[
      AnyOfValidatorOpenAndClosedShapesAnyOf0::check<>,
      AnyOfValidatorOpenAndClosedShapesAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorOpenAndClosedShapes {
    return self::check($this->input, $this->pointer);
  }
}
