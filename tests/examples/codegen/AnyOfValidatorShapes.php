<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<0a79c5a2b4cdbd407b5c69fb9125b3ed>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfValidatorShapesAnyOf0 = shape(
  ?'foo' => int,
  'bar' => vec<int>,
);

type TAnyOfValidatorShapesAnyOf1 = shape(
  ?'foo' => string,
);

type TAnyOfValidatorShapes = nonnull;

final class AnyOfValidatorShapesAnyOf0PropertiesFoo {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorShapesAnyOf0PropertiesBarItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorShapesAnyOf0PropertiesBar {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<int> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = AnyOfValidatorShapesAnyOf0PropertiesBarItems::check(
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

final class AnyOfValidatorShapesAnyOf0 {

  private static keyset<string> $required = keyset[
    'bar',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'foo',
    'bar',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorShapesAnyOf0 {
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
        $output['foo'] = AnyOfValidatorShapesAnyOf0PropertiesFoo::check(
          $typed['foo'],
          JsonSchema\get_pointer($pointer, 'foo'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'bar')) {
      try {
        $output['bar'] = AnyOfValidatorShapesAnyOf0PropertiesBar::check(
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

final class AnyOfValidatorShapesAnyOf1PropertiesFoo {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfValidatorShapesAnyOf1 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'foo',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorShapesAnyOf1 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = AnyOfValidatorShapesAnyOf1PropertiesFoo::check(
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

final class AnyOfValidatorShapes
  extends JsonSchema\BaseValidator<TAnyOfValidatorShapes> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidatorShapes {
    $constraints = vec[
      AnyOfValidatorShapesAnyOf0::check<>,
      AnyOfValidatorShapesAnyOf1::check<>,
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
  protected function process(): TAnyOfValidatorShapes {
    return self::check($this->input, $this->pointer);
  }
}
