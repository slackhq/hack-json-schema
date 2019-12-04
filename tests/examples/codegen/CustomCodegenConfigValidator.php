<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<382dad807d4cd9f1961d199e67fe255b>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type custom_codegen_config_validator_properties_string_or_num_t = mixed;

type custom_codegen_config_validator_properties_friends_items_t = shape(
  'first_name' => string,
  'last_name' => string,
  ?'age' => int,
);

type custom_codegen_config_validator_properties_devices_items_any_of_types_phone_t = shape(
  'type' => string,
  'model' => string,
  'carrier' => string,
  ?'number' => string,
  ...
);

type custom_codegen_config_validator_properties_devices_items_any_of_types_computer_t = shape(
  'type' => string,
  'manufacturer' => string,
  ?'year' => int,
  ...
);

type custom_codegen_config_validator_properties_devices_items_t = mixed;

type custom_codegen_config_validator_t = shape(
  'first_name' => string,
  'last_name' => string,
  ?'age' => int,
  ?'string_or_num' => custom_codegen_config_validator_properties_string_or_num_t,
  ?'friends' => vec<custom_codegen_config_validator_properties_friends_items_t>,
  ?'string_and_number' => vec<mixed>,
  ?'devices' => vec<custom_codegen_config_validator_properties_devices_items_t>,
  ...
);

final class CustomCodegenConfigValidatorPropertiesFirstName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesLastName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesAge {

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

final class CustomCodegenConfigValidatorPropertiesStringOrNumAnyOf0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesStringOrNumAnyOf1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesStringOrNum {

  public static function check(
    mixed $input,
    string $pointer,
  ): custom_codegen_config_validator_properties_string_or_num_t {
    $constraints = vec[
      class_meth(CustomCodegenConfigValidatorPropertiesStringOrNumAnyOf0::class, 'check'),
      class_meth(CustomCodegenConfigValidatorPropertiesStringOrNumAnyOf1::class, 'check'),
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

final class CustomCodegenConfigValidatorPropertiesFriendsItemsPropertiesFirstName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesFriendsItemsPropertiesLastName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesFriendsItemsPropertiesAge {

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

final class CustomCodegenConfigValidatorPropertiesFriendsItems {

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
  ): custom_codegen_config_validator_properties_friends_items_t {
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
        $output['first_name'] = CustomCodegenConfigValidatorPropertiesFriendsItemsPropertiesFirstName::check(
          $typed['first_name'],
          JsonSchema\get_pointer($pointer, 'first_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'last_name')) {
      try {
        $output['last_name'] = CustomCodegenConfigValidatorPropertiesFriendsItemsPropertiesLastName::check(
          $typed['last_name'],
          JsonSchema\get_pointer($pointer, 'last_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = CustomCodegenConfigValidatorPropertiesFriendsItemsPropertiesAge::check(
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

final class CustomCodegenConfigValidatorPropertiesFriends {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<custom_codegen_config_validator_properties_friends_items_t> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = CustomCodegenConfigValidatorPropertiesFriendsItems::check(
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

final class CustomCodegenConfigValidatorItemsPropertiesStringAndNumber0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorItemsPropertiesStringAndNumber1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesStringAndNumber {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<mixed> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];
    $constraints = vec[
      class_meth(CustomCodegenConfigValidatorItemsPropertiesStringAndNumber0::class, 'check'),
      class_meth(CustomCodegenConfigValidatorItemsPropertiesStringAndNumber1::class, 'check'),
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

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesType {

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

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesCarrier {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesNumber {

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

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhoneAdditionalProperties {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhone {

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
  ): custom_codegen_config_validator_properties_devices_items_any_of_types_phone_t {
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
        $output['type'] = CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesType::check(
          $typed['type'],
          JsonSchema\get_pointer($pointer, 'type'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'model')) {
      try {
        $output['model'] = CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesModel::check(
          $typed['model'],
          JsonSchema\get_pointer($pointer, 'model'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'carrier')) {
      try {
        $output['carrier'] = CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesCarrier::check(
          $typed['carrier'],
          JsonSchema\get_pointer($pointer, 'carrier'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'number')) {
      try {
        $output['number'] = CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhonePropertiesNumber::check(
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
        CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhoneAdditionalProperties::check(
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

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesType {

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

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesManufacturer {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesYear {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputer {

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
  ): custom_codegen_config_validator_properties_devices_items_any_of_types_computer_t {
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
        $output['type'] = CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesType::check(
          $typed['type'],
          JsonSchema\get_pointer($pointer, 'type'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'manufacturer')) {
      try {
        $output['manufacturer'] = CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesManufacturer::check(
          $typed['manufacturer'],
          JsonSchema\get_pointer($pointer, 'manufacturer'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'year')) {
      try {
        $output['year'] = CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputerPropertiesYear::check(
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

final class CustomCodegenConfigValidatorPropertiesDevicesItems {

  public static function check(
    mixed $input,
    string $pointer,
  ): custom_codegen_config_validator_properties_devices_items_t {
    $key = 'type';
    $typed = Constraints\ObjectConstraint::check($input, $pointer, false);

    Constraints\ObjectRequiredConstraint::check($typed, keyset[$key], $pointer);
    $type_name = ($typed[$key] ?? null) as nonnull;
    $field_pointer = JsonSchema\get_pointer($pointer, $key);
    $type_name =
      Constraints\StringConstraint::check($type_name, $field_pointer, false);

    $types = dict[
      'phone' =>
        class_meth(CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesPhone::class, 'check'),
      'computer' =>
        class_meth(CustomCodegenConfigValidatorPropertiesDevicesItemsAnyOfTypesComputer::class, 'check'),
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

final class CustomCodegenConfigValidatorPropertiesDevices {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<custom_codegen_config_validator_properties_devices_items_t> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = CustomCodegenConfigValidatorPropertiesDevicesItems::check(
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

final class CustomCodegenConfigValidator
  extends JsonSchema\BaseValidator<custom_codegen_config_validator_t> {

  private static keyset<string> $required = keyset[
    'first_name',
    'last_name',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): custom_codegen_config_validator_t {
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
        $output['first_name'] = CustomCodegenConfigValidatorPropertiesFirstName::check(
          $typed['first_name'],
          JsonSchema\get_pointer($pointer, 'first_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'last_name')) {
      try {
        $output['last_name'] = CustomCodegenConfigValidatorPropertiesLastName::check(
          $typed['last_name'],
          JsonSchema\get_pointer($pointer, 'last_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = CustomCodegenConfigValidatorPropertiesAge::check(
          $typed['age'],
          JsonSchema\get_pointer($pointer, 'age'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'string_or_num')) {
      try {
        $output['string_or_num'] = CustomCodegenConfigValidatorPropertiesStringOrNum::check(
          $typed['string_or_num'],
          JsonSchema\get_pointer($pointer, 'string_or_num'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'friends')) {
      try {
        $output['friends'] = CustomCodegenConfigValidatorPropertiesFriends::check(
          $typed['friends'],
          JsonSchema\get_pointer($pointer, 'friends'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'string_and_number')) {
      try {
        $output['string_and_number'] = CustomCodegenConfigValidatorPropertiesStringAndNumber::check(
          $typed['string_and_number'],
          JsonSchema\get_pointer($pointer, 'string_and_number'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'devices')) {
      try {
        $output['devices'] = CustomCodegenConfigValidatorPropertiesDevices::check(
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
  final protected function process(): custom_codegen_config_validator_t {
    return self::check($this->input, $this->pointer);
  }
}
