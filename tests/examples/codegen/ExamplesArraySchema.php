<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<848e6b1b640df71f3464adfac0a87004>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExamplesArraySchemaPropertiesUnsupportedUniqueItemsItems = shape(
  ?'foo' => string,
  ...
);

type TExamplesArraySchema = shape(
  ?'array_of_strings' => vec<string>,
  ?'untyped_array' => vec<mixed>,
  ?'coerce_array' => vec<num>,
  ?'unique_strings' => keyset<string>,
  ?'unique_strings_ref' => keyset<string>,
  ?'unique_numbers' => keyset<int>,
  ?'unique_numbers_coerce' => keyset<int>,
  ?'unsupported_unique_items' => vec<TExamplesArraySchemaPropertiesUnsupportedUniqueItemsItems>,
  ?'hack_enum_items' => vec<\Slack\Hack\JsonSchema\Tests\TestStringEnum>,
  ?'unique_hack_enum_items' => keyset<\Slack\Hack\JsonSchema\Tests\TestStringEnum>,
  ?'unique_hack_enum_items_ref' => keyset<\Slack\Hack\JsonSchema\Tests\TestStringEnum>,
  ...
);

final class ExamplesArraySchemaPropertiesArrayOfStringsItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesArraySchemaPropertiesArrayOfStrings {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesArraySchemaPropertiesArrayOfStringsItems::check(
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

final class ExamplesArraySchemaPropertiesUntypedArray {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<mixed> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesArraySchemaPropertiesCoerceArrayItems {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): num {
    $typed = Constraints\NumberConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesArraySchemaPropertiesCoerceArray {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): vec<num> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesArraySchemaPropertiesCoerceArrayItems::check(
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

final class ExamplesArraySchemaPropertiesUniqueStringsItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesArraySchemaPropertiesUniqueStrings {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): keyset<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesArraySchemaPropertiesUniqueStringsItems::check(
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

final class ExamplesArraySchemaPropertiesUniqueStringsRef {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): keyset<string> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesStringSchemaDefinitionsSimple::check(
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

final class ExamplesArraySchemaPropertiesUniqueNumbersItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesArraySchemaPropertiesUniqueNumbers {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): keyset<int> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesArraySchemaPropertiesUniqueNumbersItems::check(
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

final class ExamplesArraySchemaPropertiesUniqueNumbersCoerceItems {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesArraySchemaPropertiesUniqueNumbersCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): keyset<int> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesArraySchemaPropertiesUniqueNumbersCoerceItems::check(
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

final class ExamplesArraySchemaPropertiesUnsupportedUniqueItemsItemsPropertiesFoo {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExamplesArraySchemaPropertiesUnsupportedUniqueItemsItems {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesArraySchemaPropertiesUnsupportedUniqueItemsItems {
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
        $output['foo'] = ExamplesArraySchemaPropertiesUnsupportedUniqueItemsItemsPropertiesFoo::check(
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

final class ExamplesArraySchemaPropertiesUnsupportedUniqueItems {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TExamplesArraySchemaPropertiesUnsupportedUniqueItemsItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExamplesArraySchemaPropertiesUnsupportedUniqueItemsItems::check(
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

final class ExamplesArraySchemaPropertiesHackEnumItemsItems {

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

final class ExamplesArraySchemaPropertiesHackEnumItems {

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
        $output[] = ExamplesArraySchemaPropertiesHackEnumItemsItems::check(
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

final class ExamplesArraySchemaPropertiesUniqueHackEnumItemsItems {

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

final class ExamplesArraySchemaPropertiesUniqueHackEnumItems {

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
        $output[] = ExamplesArraySchemaPropertiesUniqueHackEnumItemsItems::check(
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

final class ExamplesArraySchemaPropertiesUniqueHackEnumItemsRef {

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
        $output[] = ExamplesStringSchemaDefinitionsHackEnum::check(
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

final class ExamplesArraySchema
  extends JsonSchema\BaseValidator<TExamplesArraySchema> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesArraySchema {
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
        $output['array_of_strings'] = ExamplesArraySchemaPropertiesArrayOfStrings::check(
          $typed['array_of_strings'],
          JsonSchema\get_pointer($pointer, 'array_of_strings'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'untyped_array')) {
      try {
        $output['untyped_array'] = ExamplesArraySchemaPropertiesUntypedArray::check(
          $typed['untyped_array'],
          JsonSchema\get_pointer($pointer, 'untyped_array'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'coerce_array')) {
      try {
        $output['coerce_array'] = ExamplesArraySchemaPropertiesCoerceArray::check(
          $typed['coerce_array'],
          JsonSchema\get_pointer($pointer, 'coerce_array'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_strings')) {
      try {
        $output['unique_strings'] = ExamplesArraySchemaPropertiesUniqueStrings::check(
          $typed['unique_strings'],
          JsonSchema\get_pointer($pointer, 'unique_strings'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_strings_ref')) {
      try {
        $output['unique_strings_ref'] = ExamplesArraySchemaPropertiesUniqueStringsRef::check(
          $typed['unique_strings_ref'],
          JsonSchema\get_pointer($pointer, 'unique_strings_ref'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_numbers')) {
      try {
        $output['unique_numbers'] = ExamplesArraySchemaPropertiesUniqueNumbers::check(
          $typed['unique_numbers'],
          JsonSchema\get_pointer($pointer, 'unique_numbers'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_numbers_coerce')) {
      try {
        $output['unique_numbers_coerce'] = ExamplesArraySchemaPropertiesUniqueNumbersCoerce::check(
          $typed['unique_numbers_coerce'],
          JsonSchema\get_pointer($pointer, 'unique_numbers_coerce'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unsupported_unique_items')) {
      try {
        $output['unsupported_unique_items'] = ExamplesArraySchemaPropertiesUnsupportedUniqueItems::check(
          $typed['unsupported_unique_items'],
          JsonSchema\get_pointer($pointer, 'unsupported_unique_items'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'hack_enum_items')) {
      try {
        $output['hack_enum_items'] = ExamplesArraySchemaPropertiesHackEnumItems::check(
          $typed['hack_enum_items'],
          JsonSchema\get_pointer($pointer, 'hack_enum_items'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_hack_enum_items')) {
      try {
        $output['unique_hack_enum_items'] = ExamplesArraySchemaPropertiesUniqueHackEnumItems::check(
          $typed['unique_hack_enum_items'],
          JsonSchema\get_pointer($pointer, 'unique_hack_enum_items'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'unique_hack_enum_items_ref')) {
      try {
        $output['unique_hack_enum_items_ref'] = ExamplesArraySchemaPropertiesUniqueHackEnumItemsRef::check(
          $typed['unique_hack_enum_items_ref'],
          JsonSchema\get_pointer($pointer, 'unique_hack_enum_items_ref'),
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
  protected function process(): TExamplesArraySchema {
    return self::check($this->input, $this->pointer);
  }
}
