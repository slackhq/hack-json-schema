<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<607093c6042ce20c35f08cdd96dbcf26>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TGeoSchemaExtension2ValidatorAllOf = shape(
  'date_tagged' => int,
  ?'name' => string,
  'altitude' => num,
  'latitude' => num,
  'longitude' => num,
);

type TGeoSchemaExtension2Validator = TGeoSchemaExtension2ValidatorAllOf;

final class GeoSchemaExtension2ValidatorAllOfPropertiesDateTagged {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class GeoSchemaExtension2ValidatorAllOfPropertiesName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class GeoSchemaExtension2ValidatorAllOfPropertiesAltitude {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class GeoSchemaExtension2ValidatorAllOfPropertiesLatitude {

  private static int $maximum = 90;
  private static int $minimum = -90;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMaximumConstraint::check(
      $typed,
      self::$maximum,
      $pointer,
    );
    Constraints\NumberMinimumConstraint::check(
      $typed,
      self::$minimum,
      $pointer,
    );
    return $typed;
  }
}

final class GeoSchemaExtension2ValidatorAllOfPropertiesLongitude {

  private static int $maximum = 180;
  private static int $minimum = -180;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMaximumConstraint::check(
      $typed,
      self::$maximum,
      $pointer,
    );
    Constraints\NumberMinimumConstraint::check(
      $typed,
      self::$minimum,
      $pointer,
    );
    return $typed;
  }
}

final class GeoSchemaExtension2ValidatorAllOf {

  private static keyset<string> $required = keyset[
    'date_tagged',
    'altitude',
    'latitude',
    'longitude',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'date_tagged',
    'name',
    'altitude',
    'latitude',
    'longitude',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TGeoSchemaExtension2ValidatorAllOf {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'date_tagged')) {
      try {
        $output['date_tagged'] = GeoSchemaExtension2ValidatorAllOfPropertiesDateTagged::check(
          $typed['date_tagged'],
          JsonSchema\get_pointer($pointer, 'date_tagged'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'name')) {
      try {
        $output['name'] = GeoSchemaExtension2ValidatorAllOfPropertiesName::check(
          $typed['name'],
          JsonSchema\get_pointer($pointer, 'name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'altitude')) {
      try {
        $output['altitude'] = GeoSchemaExtension2ValidatorAllOfPropertiesAltitude::check(
          $typed['altitude'],
          JsonSchema\get_pointer($pointer, 'altitude'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'latitude')) {
      try {
        $output['latitude'] = GeoSchemaExtension2ValidatorAllOfPropertiesLatitude::check(
          $typed['latitude'],
          JsonSchema\get_pointer($pointer, 'latitude'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'longitude')) {
      try {
        $output['longitude'] = GeoSchemaExtension2ValidatorAllOfPropertiesLongitude::check(
          $typed['longitude'],
          JsonSchema\get_pointer($pointer, 'longitude'),
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

final class GeoSchemaExtension2Validator
  extends JsonSchema\BaseValidator<TGeoSchemaExtension2Validator> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TGeoSchemaExtension2Validator {
    return GeoSchemaExtension2ValidatorAllOf::check($input, $pointer);
  }

  <<__Override>>
  protected function process(): TGeoSchemaExtension2Validator {
    return self::check($this->input, $this->pointer);
  }
}
