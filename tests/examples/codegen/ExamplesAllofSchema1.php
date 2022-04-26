<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<d86fe60f9a4b277d13542c3017f28e35>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExamplesAllofSchema1AllOf = shape(
  'bar' => int,
  'foo' => int,
);

type TExamplesAllofSchema1 = mixed;

final class ExamplesAllofSchema1AllOfPropertiesBar {

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

final class ExamplesAllofSchema1AllOfPropertiesFoo {

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

final class ExamplesAllofSchema1AllOf {

  private static keyset<string> $required = keyset[
    'bar',
    'foo',
  ];
  private static bool $coerce = true;
  private static keyset<string> $properties = keyset[
    'bar',
    'foo',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesAllofSchema1AllOf {
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
        $output['bar'] = ExamplesAllofSchema1AllOfPropertiesBar::check(
          $typed['bar'],
          JsonSchema\get_pointer($pointer, 'bar'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = ExamplesAllofSchema1AllOfPropertiesFoo::check(
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

final class ExamplesAllofSchema1
  extends JsonSchema\BaseValidator<TExamplesAllofSchema1> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesAllofSchema1 {
    return ExamplesAllofSchema1AllOf::check($input, $pointer);
  }

  <<__Override>>
  protected function process(): TExamplesAllofSchema1 {
    return self::check($this->input, $this->pointer);
  }
}
