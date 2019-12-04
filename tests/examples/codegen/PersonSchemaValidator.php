<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<a85c480d96606dc8072ca84f25e8e734>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TPersonSchemaValidatorPropertiesStringOrNum = mixed;

type TPersonSchemaValidatorPropertiesFriendsItems = shape(
  'first_name' => string,
  'last_name' => string,
  ?'age' => int,
);

type TPersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhone = shape(
  'type' => string,
  'model' => string,
  'carrier' => string,
  ?'number' => string,
  ...
);

type TPersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputer = shape(
  'type' => string,
  'manufacturer' => string,
  ?'year' => int,
  ...
);

type TPersonSchemaValidatorPropertiesDevicesItems = mixed;

type TPersonSchemaValidator = shape(
  'first_name' => string,
  'last_name' => string,
  ?'age' => int,
  ?'string_or_num' => TPersonSchemaValidatorPropertiesStringOrNum,
  ?'friends' => vec<TPersonSchemaValidatorPropertiesFriendsItems>,
  ?'string_and_number' => vec<mixed>,
  ?'devices' => vec<TPersonSchemaValidatorPropertiesDevicesItems>,
  ...
);

final class PersonSchemaValidatorPropertiesFirstName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesLastName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesAge {

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

final class PersonSchemaValidatorPropertiesStringOrNumAnyOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesStringOrNumAnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesStringOrNum {

  public static function check(
    mixed $input,
    string $pointer,
  ): TPersonSchemaValidatorPropertiesStringOrNum {
    $constraints = vec[
      class_meth(PersonSchemaValidatorPropertiesStringOrNumAnyOf0::class, 'check'),
      class_meth(PersonSchemaValidatorPropertiesStringOrNumAnyOf1::class, 'check'),
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

final class PersonSchemaValidatorPropertiesFriendsItemsPropertiesFirstName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesFriendsItemsPropertiesLastName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesFriendsItemsPropertiesAge {

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

final class PersonSchemaValidatorPropertiesFriendsItems {

  private static keyset<string> $required = keyset[
    'first_name',
    'last_name',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'first_name',
    'last_name',
    'age',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TPersonSchemaValidatorPropertiesFriendsItems {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'first_name')) {
      try {
        $output['first_name'] = PersonSchemaValidatorPropertiesFriendsItemsPropertiesFirstName::check(
          $typed['first_name'],
          JsonSchema\get_pointer($pointer, 'first_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'last_name')) {
      try {
        $output['last_name'] = PersonSchemaValidatorPropertiesFriendsItemsPropertiesLastName::check(
          $typed['last_name'],
          JsonSchema\get_pointer($pointer, 'last_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = PersonSchemaValidatorPropertiesFriendsItemsPropertiesAge::check(
          $typed['age'],
          JsonSchema\get_pointer($pointer, 'age'),
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

final class PersonSchemaValidatorPropertiesFriends {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TPersonSchemaValidatorPropertiesFriendsItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = PersonSchemaValidatorPropertiesFriendsItems::check(
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

final class PersonSchemaValidatorItemsPropertiesStringAndNumber0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorItemsPropertiesStringAndNumber1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesStringAndNumber {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<mixed> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];
    $constraints = vec[
      class_meth(PersonSchemaValidatorItemsPropertiesStringAndNumber0::class, 'check'),
      class_meth(PersonSchemaValidatorItemsPropertiesStringAndNumber1::class, 'check'),
    ];

    foreach ($typed as $index => $value) {
      try {
        if ($index < \HH\Lib\C\count($constraints)) {
          $constraint = $constraints[$index];
          $output[] = $constraint(
            $value,
            JsonSchema\get_pointer($pointer, (string) $index),
          );
        } else {
          $output[] = $value;
        }
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

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesType {

  private static vec<mixed> $enum = vec[
    'phone',
  ];
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\EnumConstraint::check($typed, self::$enum, $pointer);
    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesCarrier {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesNumber {

  private static string $pattern = '^(\\([0-9]{3}\\))?[0-9]{3}-[0-9]{4}$';
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\StringPatternConstraint::check(
      $typed,
      self::$pattern,
      $pointer,
    );
    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhoneAdditionalProperties {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhone {

  private static keyset<string> $required = keyset[
    'model',
    'carrier',
    'type',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'type',
    'model',
    'carrier',
    'number',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TPersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhone {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    if (\HH\Lib\C\contains_key($typed, 'type')) {
      try {
        $output['type'] = PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesType::check(
          $typed['type'],
          JsonSchema\get_pointer($pointer, 'type'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'model')) {
      try {
        $output['model'] = PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesModel::check(
          $typed['model'],
          JsonSchema\get_pointer($pointer, 'model'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'carrier')) {
      try {
        $output['carrier'] = PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesCarrier::check(
          $typed['carrier'],
          JsonSchema\get_pointer($pointer, 'carrier'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number')) {
      try {
        $output['number'] = PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesNumber::check(
          $typed['number'],
          JsonSchema\get_pointer($pointer, 'number'),
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

      try {
        PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhoneAdditionalProperties::check(
          $value,
          JsonSchema\get_pointer($pointer, $key),
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

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesType {

  private static vec<mixed> $enum = vec[
    'computer',
  ];
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    Constraints\EnumConstraint::check($typed, self::$enum, $pointer);
    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesManufacturer {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesYear {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputer {

  private static keyset<string> $required = keyset[
    'manufacturer',
    'type',
  ];
  private static bool $coerce = false;
  private static keyset<string> $properties = keyset[
    'type',
    'manufacturer',
    'year',
  ];

  public static function check(
    mixed $input,
    string $pointer,
  ): TPersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputer {
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

    if (\HH\Lib\C\contains_key($typed, 'type')) {
      try {
        $output['type'] = PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesType::check(
          $typed['type'],
          JsonSchema\get_pointer($pointer, 'type'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'manufacturer')) {
      try {
        $output['manufacturer'] = PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesManufacturer::check(
          $typed['manufacturer'],
          JsonSchema\get_pointer($pointer, 'manufacturer'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'year')) {
      try {
        $output['year'] = PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesYear::check(
          $typed['year'],
          JsonSchema\get_pointer($pointer, 'year'),
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

final class PersonSchemaValidatorPropertiesDevicesItems {

  public static function check(
    mixed $input,
    string $pointer,
  ): TPersonSchemaValidatorPropertiesDevicesItems {
    $key = 'type';
    $typed = Constraints\ObjectConstraint::check($input, $pointer, false);

    Constraints\ObjectRequiredConstraint::check($typed, keyset[$key], $pointer);
    $type_name = ($typed[$key] ?? null) as nonnull;
    $field_pointer = JsonSchema\get_pointer($pointer, $key);
    $type_name =
      Constraints\StringConstraint::check($type_name, $field_pointer, false);

    $types = dict[
      'phone' =>
        class_meth(PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesPhone::class, 'check'),
      'computer' =>
        class_meth(PersonSchemaValidatorPropertiesDevicesItemsAnyOfTypesComputer::class, 'check'),
    ];

    $constraint = $types[$type_name] ?? null;
    if ($constraint === null) {
      $error = shape(
        'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
        'constraint' => shape(
          'type' => JsonSchema\FieldErrorConstraint::ENUM,
          'expected' => \HH\Lib\Vec\keys($types),
          'got' => $type_name,
        ),
        'message' => "unsupported type: {$type_name}",
      );
      throw new JsonSchema\InvalidFieldException($field_pointer, vec[$error]);
    }

    return $constraint($typed, $pointer);
  }
}

final class PersonSchemaValidatorPropertiesDevices {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TPersonSchemaValidatorPropertiesDevicesItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = PersonSchemaValidatorPropertiesDevicesItems::check(
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

final class PersonSchemaValidator
  extends JsonSchema\BaseValidator<TPersonSchemaValidator> {

  private static keyset<string> $required = keyset[
    'first_name',
    'last_name',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TPersonSchemaValidator {
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

    if (\HH\Lib\C\contains_key($typed, 'first_name')) {
      try {
        $output['first_name'] = PersonSchemaValidatorPropertiesFirstName::check(
          $typed['first_name'],
          JsonSchema\get_pointer($pointer, 'first_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'last_name')) {
      try {
        $output['last_name'] = PersonSchemaValidatorPropertiesLastName::check(
          $typed['last_name'],
          JsonSchema\get_pointer($pointer, 'last_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = PersonSchemaValidatorPropertiesAge::check(
          $typed['age'],
          JsonSchema\get_pointer($pointer, 'age'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'string_or_num')) {
      try {
        $output['string_or_num'] = PersonSchemaValidatorPropertiesStringOrNum::check(
          $typed['string_or_num'],
          JsonSchema\get_pointer($pointer, 'string_or_num'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'friends')) {
      try {
        $output['friends'] = PersonSchemaValidatorPropertiesFriends::check(
          $typed['friends'],
          JsonSchema\get_pointer($pointer, 'friends'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'string_and_number')) {
      try {
        $output['string_and_number'] = PersonSchemaValidatorPropertiesStringAndNumber::check(
          $typed['string_and_number'],
          JsonSchema\get_pointer($pointer, 'string_and_number'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'devices')) {
      try {
        $output['devices'] = PersonSchemaValidatorPropertiesDevices::check(
          $typed['devices'],
          JsonSchema\get_pointer($pointer, 'devices'),
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
  final protected function process(): TPersonSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
