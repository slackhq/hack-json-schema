<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<744a2b24c9dbb1c16d057e9978f2578d>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAddressSchemaValidatorPropertiesPhonesItems = shape(
  'model' => string,
  ?'carrier/provider' => string,
  ...
);

type TAddressSchemaValidatorPropertiesPostalCode = mixed;

type TAddressSchemaValidatorPropertiesSize = mixed;

type TAddressSchemaValidatorPropertiesLongitude = mixed;

type TAddressSchemaValidatorPropertiesLatitude = mixed;

type TAddressSchemaValidator = shape(
  ?'post-office-box' => string,
  ?'extended-address' => string,
  ?'street-address' => string,
  'locality' => string,
  'region' => string,
  ?'phones' => vec<TAddressSchemaValidatorPropertiesPhonesItems>,
  ?'postal-code' => TAddressSchemaValidatorPropertiesPostalCode,
  ?'size' => TAddressSchemaValidatorPropertiesSize,
  ?'longitude' => TAddressSchemaValidatorPropertiesLongitude,
  ?'latitude' => TAddressSchemaValidatorPropertiesLatitude,
  'country-name' => string,
  ...
);

final class AddressSchemaValidatorPropertiesPostOfficeBox {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesExtendedAddress {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesStreetAddress {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesLocality {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesRegion {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesPhonesItemsPropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesPhonesItemsPropertiesCarrierNanProvider {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesPhonesItems {

  private static keyset<string> $required = keyset[
    'model',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaValidatorPropertiesPhonesItems {
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

    if (\HH\Lib\C\contains_key($typed, 'model')) {
      try {
        $output['model'] = AddressSchemaValidatorPropertiesPhonesItemsPropertiesModel::check(
          $typed['model'],
          JsonSchema\get_pointer($pointer, 'model'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'carrier/provider')) {
      try {
        $output['carrier/provider'] = AddressSchemaValidatorPropertiesPhonesItemsPropertiesCarrierNanProvider::check(
          $typed['carrier/provider'],
          JsonSchema\get_pointer($pointer, 'carrier/provider'),
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

final class AddressSchemaValidatorPropertiesPhones {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TAddressSchemaValidatorPropertiesPhonesItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = AddressSchemaValidatorPropertiesPhonesItems::check(
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

final class AddressSchemaValidatorPropertiesPostalCodeAnyOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesPostalCodeAnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesPostalCode {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaValidatorPropertiesPostalCode {
    $constraints = vec[
      class_meth(AddressSchemaValidatorPropertiesPostalCodeAnyOf0::class, 'check'),
      class_meth(AddressSchemaValidatorPropertiesPostalCodeAnyOf1::class, 'check'),
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
      'message' => "failed to match any allowed schemas",
    );

    $output_errors = vec[$error];
    $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
    throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
  }
}

final class AddressSchemaValidatorPropertiesSizeAllOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesSizeAllOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesSize {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaValidatorPropertiesSize {
    $constraints = vec[
      class_meth(AddressSchemaValidatorPropertiesSizeAllOf0::class, 'check'),
      class_meth(AddressSchemaValidatorPropertiesSizeAllOf1::class, 'check'),
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
        'message' => "failed to match all allowed schemas",
      );

      $output_errors = vec[$error];
      $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
      throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
    }
    return $output;
  }
}

final class AddressSchemaValidatorPropertiesLongitudeNot0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesLongitudeNot1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesLongitude {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaValidatorPropertiesLongitude {
    $constraints = vec[
      class_meth(AddressSchemaValidatorPropertiesLongitudeNot0::class, 'check'),
      class_meth(AddressSchemaValidatorPropertiesLongitudeNot1::class, 'check'),
    ];

    $passed_any = false;
    $output = null;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($input, $pointer);
        $passed_any = true;
        break;
      } catch (JsonSchema\InvalidFieldException $e) {
      }
    }

    if ($passed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::NOT,
        ),
        'message' => "failed because matched disallowed schema",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
    return $output;
  }
}

final class AddressSchemaValidatorPropertiesLatitudeOneOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesLatitudeOneOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidatorPropertiesLatitude {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaValidatorPropertiesLatitude {
    $constraints = vec[
      class_meth(AddressSchemaValidatorPropertiesLatitudeOneOf0::class, 'check'),
      class_meth(AddressSchemaValidatorPropertiesLatitudeOneOf1::class, 'check'),
    ];

    $passed_any = false;
    $passed_multi = false;
    $output = null;
    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($input, $pointer);
        if ($passed_any) {
          $passed_multi = true;
          break;
        }
        $passed_any = true;
      } catch (JsonSchema\InvalidFieldException $e) {
      }
    }

    if ($passed_multi || !$passed_any) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ONE_OF,
        ),
        'message' => "failed to match exactly one allowed schema",
      );
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
    return $output;
  }
}

final class AddressSchemaValidatorPropertiesCountryName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaValidator
  extends JsonSchema\BaseValidator<TAddressSchemaValidator> {

  private static keyset<string> $required = keyset[
    'locality',
    'region',
    'country-name',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaValidator {
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

    if (\HH\Lib\C\contains_key($typed, 'post-office-box')) {
      try {
        $output['post-office-box'] = AddressSchemaValidatorPropertiesPostOfficeBox::check(
          $typed['post-office-box'],
          JsonSchema\get_pointer($pointer, 'post-office-box'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'extended-address')) {
      try {
        $output['extended-address'] = AddressSchemaValidatorPropertiesExtendedAddress::check(
          $typed['extended-address'],
          JsonSchema\get_pointer($pointer, 'extended-address'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'street-address')) {
      try {
        $output['street-address'] = AddressSchemaValidatorPropertiesStreetAddress::check(
          $typed['street-address'],
          JsonSchema\get_pointer($pointer, 'street-address'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'locality')) {
      try {
        $output['locality'] = AddressSchemaValidatorPropertiesLocality::check(
          $typed['locality'],
          JsonSchema\get_pointer($pointer, 'locality'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'region')) {
      try {
        $output['region'] = AddressSchemaValidatorPropertiesRegion::check(
          $typed['region'],
          JsonSchema\get_pointer($pointer, 'region'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'phones')) {
      try {
        $output['phones'] = AddressSchemaValidatorPropertiesPhones::check(
          $typed['phones'],
          JsonSchema\get_pointer($pointer, 'phones'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'postal-code')) {
      try {
        $output['postal-code'] = AddressSchemaValidatorPropertiesPostalCode::check(
          $typed['postal-code'],
          JsonSchema\get_pointer($pointer, 'postal-code'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'size')) {
      try {
        $output['size'] = AddressSchemaValidatorPropertiesSize::check(
          $typed['size'],
          JsonSchema\get_pointer($pointer, 'size'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'longitude')) {
      try {
        $output['longitude'] = AddressSchemaValidatorPropertiesLongitude::check(
          $typed['longitude'],
          JsonSchema\get_pointer($pointer, 'longitude'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'latitude')) {
      try {
        $output['latitude'] = AddressSchemaValidatorPropertiesLatitude::check(
          $typed['latitude'],
          JsonSchema\get_pointer($pointer, 'latitude'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'country-name')) {
      try {
        $output['country-name'] = AddressSchemaValidatorPropertiesCountryName::check(
          $typed['country-name'],
          JsonSchema\get_pointer($pointer, 'country-name'),
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
  final protected function process(): TAddressSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
