<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<0596f5dc3ead0787c630c9096d587b98>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf0 = shape(
  ?'qux' => string,
);

type TAnyOfNestedAnyOfAnyOf0PropertiesBar = mixed;

type TAnyOfNestedAnyOfAnyOf0 = shape(
  ?'bar' => TAnyOfNestedAnyOfAnyOf0PropertiesBar,
);

type TAnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf0 = shape(
  ?'qux' => string,
);

type TAnyOfNestedAnyOfAnyOf1PropertiesBar = mixed;

type TAnyOfNestedAnyOfAnyOf1 = shape(
  ?'bar' => TAnyOfNestedAnyOfAnyOf1PropertiesBar,
);

type TAnyOfNestedAnyOf = shape(
  ?'bar' => mixed,
);

final class AnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf0PropertiesQux {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf0 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'qux',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'qux')) {
      try {
        $output['qux'] = AnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf0PropertiesQux::check(
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

final class AnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfNestedAnyOfAnyOf0PropertiesBar {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfNestedAnyOfAnyOf0PropertiesBar {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      AnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf0::check<>,
      AnyOfNestedAnyOfAnyOf0PropertiesBarAnyOf1::check<>,
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

final class AnyOfNestedAnyOfAnyOf0 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'bar',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfNestedAnyOfAnyOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'bar')) {
      try {
        $output['bar'] = AnyOfNestedAnyOfAnyOf0PropertiesBar::check(
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

final class AnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf0PropertiesQux {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf0 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'qux',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf0 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'qux')) {
      try {
        $output['qux'] = AnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf0PropertiesQux::check(
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

final class AnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AnyOfNestedAnyOfAnyOf1PropertiesBar {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfNestedAnyOfAnyOf1PropertiesBar {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      AnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf0::check<>,
      AnyOfNestedAnyOfAnyOf1PropertiesBarAnyOf1::check<>,
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

final class AnyOfNestedAnyOfAnyOf1 {

  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'bar',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfNestedAnyOfAnyOf1 {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'bar')) {
      try {
        $output['bar'] = AnyOfNestedAnyOfAnyOf1PropertiesBar::check(
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

final class AnyOfNestedAnyOf
  extends JsonSchema\BaseValidator<TAnyOfNestedAnyOf> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfNestedAnyOf {
    $constraints = vec[
      AnyOfNestedAnyOfAnyOf0::check<>,
      AnyOfNestedAnyOfAnyOf1::check<>,
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
  protected function process(): TAnyOfNestedAnyOf {
    return self::check($this->input, $this->pointer);
  }
}
