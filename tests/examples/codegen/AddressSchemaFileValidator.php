<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<c305506985616e476d2a3e823dab1d90>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TAddressSchemaFileValidatorPropertiesPhonesItems = shape(
  'model' => int,
  ?'carrier/provider' => string,
  ...
);

type TAddressSchemaFileValidatorPropertiesRelative = shape(
  ?'nickname' => string,
  ...
);

type TAddressSchemaFileValidatorPropertiesPostalCode = mixed;

type TAddressSchemaFileValidator = shape(
  ?'post-office-box' => string,
  ?'extended-address' => string,
  ?'street-address' => string,
  'locality' => string,
  'region' => string,
  ?'phones' => vec<TAddressSchemaFileValidatorPropertiesPhonesItems>,
  ?'age' => int,
  ?'nickname' => string,
  ?'relative' => TAddressSchemaFileValidatorPropertiesRelative,
  ?'postal-code' => TAddressSchemaFileValidatorPropertiesPostalCode,
  'country-name' => string,
  ...
);

final class AddressSchemaFileValidatorPropertiesPostOfficeBox {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesExtendedAddress {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesStreetAddress {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesLocality {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesRegion {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesPhonesItemsPropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesPhonesItemsPropertiesCarrierNanProvider {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesPhonesItems {

  private static keyset<string> $required = keyset[
    'model',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaFileValidatorPropertiesPhonesItems {
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
        $output['model'] = AddressSchemaFileValidatorPropertiesPhonesItemsPropertiesModel::check(
          $typed['model'],
          JsonSchema\get_pointer($pointer, 'model'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'carrier/provider')) {
      try {
        $output['carrier/provider'] = AddressSchemaFileValidatorPropertiesPhonesItemsPropertiesCarrierNanProvider::check(
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

final class AddressSchemaFileValidatorPropertiesPhones {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TAddressSchemaFileValidatorPropertiesPhonesItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = AddressSchemaFileValidatorPropertiesPhonesItems::check(
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

final class AddressSchemaFileValidatorPropertiesAge {

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

final class AddressSchemaFileValidatorPropertiesNickname {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesRelativePropertiesNickname {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesRelative {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaFileValidatorPropertiesRelative {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'nickname')) {
      try {
        $output['nickname'] = AddressSchemaFileValidatorPropertiesRelativePropertiesNickname::check(
          $typed['nickname'],
          JsonSchema\get_pointer($pointer, 'nickname'),
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

final class AddressSchemaFileValidatorPropertiesPostalCodeAnyOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesPostalCodeAnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidatorPropertiesPostalCode {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaFileValidatorPropertiesPostalCode {
    $constraints = vec[
      class_meth(AddressSchemaFileValidatorPropertiesPostalCodeAnyOf0::class, 'check'),
      class_meth(AddressSchemaFileValidatorPropertiesPostalCodeAnyOf1::class, 'check'),
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

final class AddressSchemaFileValidatorPropertiesCountryName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class AddressSchemaFileValidator
  extends JsonSchema\BaseValidator<TAddressSchemaFileValidator> {

  private static keyset<string> $required = keyset[
    'locality',
    'region',
    'country-name',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TAddressSchemaFileValidator {
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
        $output['post-office-box'] = AddressSchemaFileValidatorPropertiesPostOfficeBox::check(
          $typed['post-office-box'],
          JsonSchema\get_pointer($pointer, 'post-office-box'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'extended-address')) {
      try {
        $output['extended-address'] = AddressSchemaFileValidatorPropertiesExtendedAddress::check(
          $typed['extended-address'],
          JsonSchema\get_pointer($pointer, 'extended-address'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'street-address')) {
      try {
        $output['street-address'] = AddressSchemaFileValidatorPropertiesStreetAddress::check(
          $typed['street-address'],
          JsonSchema\get_pointer($pointer, 'street-address'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'locality')) {
      try {
        $output['locality'] = AddressSchemaFileValidatorPropertiesLocality::check(
          $typed['locality'],
          JsonSchema\get_pointer($pointer, 'locality'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'region')) {
      try {
        $output['region'] = AddressSchemaFileValidatorPropertiesRegion::check(
          $typed['region'],
          JsonSchema\get_pointer($pointer, 'region'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'phones')) {
      try {
        $output['phones'] = AddressSchemaFileValidatorPropertiesPhones::check(
          $typed['phones'],
          JsonSchema\get_pointer($pointer, 'phones'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = AddressSchemaFileValidatorPropertiesAge::check(
          $typed['age'],
          JsonSchema\get_pointer($pointer, 'age'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'nickname')) {
      try {
        $output['nickname'] = AddressSchemaFileValidatorPropertiesNickname::check(
          $typed['nickname'],
          JsonSchema\get_pointer($pointer, 'nickname'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'relative')) {
      try {
        $output['relative'] = AddressSchemaFileValidatorPropertiesRelative::check(
          $typed['relative'],
          JsonSchema\get_pointer($pointer, 'relative'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'postal-code')) {
      try {
        $output['postal-code'] = AddressSchemaFileValidatorPropertiesPostalCode::check(
          $typed['postal-code'],
          JsonSchema\get_pointer($pointer, 'postal-code'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'country-name')) {
      try {
        $output['country-name'] = AddressSchemaFileValidatorPropertiesCountryName::check(
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
  final protected function process(): TAddressSchemaFileValidator {
    return self::check($this->input, $this->pointer);
  }
}
