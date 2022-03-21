<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<7f20c3eead69c411ea999a821ff7167a>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TArraySchemaValidatorPropertiesUnsupportedUniqueItemsItems = shape(
  ?'foo' => string,
  ...
);

type TArraySchemaValidator = shape(
  ?'array_of_strings' => vec<string>,
  ?'untyped_array' => vec<mixed>,
  ?'coerce_array' => vec<num>,
  ?'unique_strings' => keyset<string>,
  ?'unique_numbers' => keyset<int>,
  ?'unique_numbers_coerce' => keyset<int>,
  ?'unsupported_unique_items' => vec<TArraySchemaValidatorPropertiesUnsupportedUniqueItemsItems>,
  ?'hack_enum_items' => vec<\Slack\Hack\JsonSchema\Tests\TestStringEnum>,
  ?'unique_hack_enum_items' => keyset<\Slack\Hack\JsonSchema\Tests\TestStringEnum>,
  ...
);

final class ArraySchemaValidatorPropertiesArrayOfStringsItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesArrayOfStrings {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesArrayOfStringsItems::check(
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

final class ArraySchemaValidatorPropertiesUntypedArray {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<mixed> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesCoerceArrayItems {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesCoerceArray {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): vec<num> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesCoerceArrayItems::check(
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

final class ArraySchemaValidatorPropertiesUniqueStringsItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesUniqueStrings {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): keyset<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesUniqueStringsItems::check(
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

    $output = Constraints\ArrayUniqueItemsConstraint::check(
      $output,
      $pointer,
      self::$coerce,
    );

    return $output;
  }
}

final class ArraySchemaValidatorPropertiesUniqueNumbersItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesUniqueNumbers {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): keyset<int> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesUniqueNumbersItems::check(
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

    $output = Constraints\ArrayUniqueItemsConstraint::check(
      $output,
      $pointer,
      self::$coerce,
    );

    return $output;
  }
}

final class ArraySchemaValidatorPropertiesUniqueNumbersCoerceItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesUniqueNumbersCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): keyset<int> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesUniqueNumbersCoerceItems::check(
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

    $output = Constraints\ArrayUniqueItemsConstraint::check(
      $output,
      $pointer,
      self::$coerce,
    );

    return $output;
  }
}

final class ArraySchemaValidatorPropertiesUnsupportedUniqueItemsItemsPropertiesFoo {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesUnsupportedUniqueItemsItems {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TArraySchemaValidatorPropertiesUnsupportedUniqueItemsItems {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'foo')) {
      try {
        $output['foo'] = ArraySchemaValidatorPropertiesUnsupportedUniqueItemsItemsPropertiesFoo::check(
          $typed['foo'],
          JsonSchema\get_pointer($pointer, 'foo'),
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

final class ArraySchemaValidatorPropertiesUnsupportedUniqueItems {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TArraySchemaValidatorPropertiesUnsupportedUniqueItemsItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesUnsupportedUniqueItemsItems::check(
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

final class ArraySchemaValidatorPropertiesHackEnumItemsItems {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): \Slack\Hack\JsonSchema\Tests\TestStringEnum {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $typed = Constraints\HackEnumConstraint::check(
      $typed,
      \Slack\Hack\JsonSchema\Tests\TestStringEnum::class,
      $pointer,
    );
    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesHackEnumItems {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<\Slack\Hack\JsonSchema\Tests\TestStringEnum> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesHackEnumItemsItems::check(
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

final class ArraySchemaValidatorPropertiesUniqueHackEnumItemsItems {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): \Slack\Hack\JsonSchema\Tests\TestStringEnum {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $typed = Constraints\HackEnumConstraint::check(
      $typed,
      \Slack\Hack\JsonSchema\Tests\TestStringEnum::class,
      $pointer,
    );
    return $typed;
  }
}

final class ArraySchemaValidatorPropertiesUniqueHackEnumItems {

  private static bool $coerce = true;

  public static function check(
    mixed $input,
    string $pointer,
  ): keyset<\Slack\Hack\JsonSchema\Tests\TestStringEnum> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ArraySchemaValidatorPropertiesUniqueHackEnumItemsItems::check(
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

    $output = Constraints\ArrayUniqueItemsConstraint::check(
      $output,
      $pointer,
      self::$coerce,
    );

    return $output;
  }
}

final class ArraySchemaValidator
  extends JsonSchema\BaseValidator<TArraySchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TArraySchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'array_of_strings')) {
      try {
        $output['array_of_strings'] = ArraySchemaValidatorPropertiesArrayOfStrings::check(
          $typed['array_of_strings'],
          JsonSchema\get_pointer($pointer, 'array_of_strings'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'untyped_array')) {
      try {
        $output['untyped_array'] = ArraySchemaValidatorPropertiesUntypedArray::check(
          $typed['untyped_array'],
          JsonSchema\get_pointer($pointer, 'untyped_array'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'coerce_array')) {
      try {
        $output['coerce_array'] = ArraySchemaValidatorPropertiesCoerceArray::check(
          $typed['coerce_array'],
          JsonSchema\get_pointer($pointer, 'coerce_array'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_strings')) {
      try {
        $output['unique_strings'] = ArraySchemaValidatorPropertiesUniqueStrings::check(
          $typed['unique_strings'],
          JsonSchema\get_pointer($pointer, 'unique_strings'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_numbers')) {
      try {
        $output['unique_numbers'] = ArraySchemaValidatorPropertiesUniqueNumbers::check(
          $typed['unique_numbers'],
          JsonSchema\get_pointer($pointer, 'unique_numbers'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_numbers_coerce')) {
      try {
        $output['unique_numbers_coerce'] = ArraySchemaValidatorPropertiesUniqueNumbersCoerce::check(
          $typed['unique_numbers_coerce'],
          JsonSchema\get_pointer($pointer, 'unique_numbers_coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unsupported_unique_items')) {
      try {
        $output['unsupported_unique_items'] = ArraySchemaValidatorPropertiesUnsupportedUniqueItems::check(
          $typed['unsupported_unique_items'],
          JsonSchema\get_pointer($pointer, 'unsupported_unique_items'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'hack_enum_items')) {
      try {
        $output['hack_enum_items'] = ArraySchemaValidatorPropertiesHackEnumItems::check(
          $typed['hack_enum_items'],
          JsonSchema\get_pointer($pointer, 'hack_enum_items'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_hack_enum_items')) {
      try {
        $output['unique_hack_enum_items'] = ArraySchemaValidatorPropertiesUniqueHackEnumItems::check(
          $typed['unique_hack_enum_items'],
          JsonSchema\get_pointer($pointer, 'unique_hack_enum_items'),
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
  protected function process(): TArraySchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
