<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<e5d9c20b4c10348eeeda65941249e506>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TGeoSchemaValidator = shape(
  'latitude' => num,
  'longitude' => num,
  ...
);

final class GeoSchemaValidatorPropertiesLatitude {

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

final class GeoSchemaValidatorPropertiesLongitude {

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

final class GeoSchemaValidator
  extends JsonSchema\BaseValidator<TGeoSchemaValidator> {

  private static keyset<string> $required = keyset[
    'latitude',
    'longitude',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TGeoSchemaValidator {
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

    if (\HH\Lib\C\contains_key($typed, 'latitude')) {
      try {
        $output['latitude'] = GeoSchemaValidatorPropertiesLatitude::check(
          $typed['latitude'],
          JsonSchema\get_pointer($pointer, 'latitude'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'longitude')) {
      try {
        $output['longitude'] = GeoSchemaValidatorPropertiesLongitude::check(
          $typed['longitude'],
          JsonSchema\get_pointer($pointer, 'longitude'),
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
  final protected function process(): TGeoSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
