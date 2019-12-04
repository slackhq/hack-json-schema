<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<9adb23148226f50b1a0f4cbec7aef894>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TCodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItems = shape(
  'model' => int,
  ?'carrier/provider' => string,
  ...
);

type TCodegenForSchemaFriendsSchemaItems = shape(
  'first_name' => string,
  'last_name' => string,
  ?'age' => int,
  ?'~devices/' => vec<TCodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItems>,
  ...
);

final class CodegenForSchemaFriendsSchemaItemsPropertiesFirstName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CodegenForSchemaFriendsSchemaItemsPropertiesLastName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CodegenForSchemaFriendsSchemaItemsPropertiesAge {

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

final class CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItemsPropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItemsPropertiesCarrierNanProvider {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItems {

  private static keyset<string> $required = keyset[
    'model',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TCodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItems {
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
        $output['model'] = CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItemsPropertiesModel::check(
          $typed['model'],
          JsonSchema\get_pointer($pointer, 'model'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'carrier/provider')) {
      try {
        $output['carrier/provider'] = CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItemsPropertiesCarrierNanProvider::check(
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

final class CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNan {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TCodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNanItems::check(
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

final class CodegenForSchemaFriendsSchemaItems {

  private static keyset<string> $required = keyset[
    'first_name',
    'last_name',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TCodegenForSchemaFriendsSchemaItems {
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
        $output['first_name'] = CodegenForSchemaFriendsSchemaItemsPropertiesFirstName::check(
          $typed['first_name'],
          JsonSchema\get_pointer($pointer, 'first_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'last_name')) {
      try {
        $output['last_name'] = CodegenForSchemaFriendsSchemaItemsPropertiesLastName::check(
          $typed['last_name'],
          JsonSchema\get_pointer($pointer, 'last_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = CodegenForSchemaFriendsSchemaItemsPropertiesAge::check(
          $typed['age'],
          JsonSchema\get_pointer($pointer, 'age'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, '~devices/')) {
      try {
        $output['~devices/'] = CodegenForSchemaFriendsSchemaItemsPropertiesNanDevicesNan::check(
          $typed['~devices/'],
          JsonSchema\get_pointer($pointer, '~devices/'),
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

final class CodegenForSchemaFriendsSchema
  extends JsonSchema\BaseValidator<vec<TCodegenForSchemaFriendsSchemaItems>> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TCodegenForSchemaFriendsSchemaItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = CodegenForSchemaFriendsSchemaItems::check(
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

  <<__Override>>
  final protected function process(): vec<TCodegenForSchemaFriendsSchemaItems> {
    return self::check($this->input, $this->pointer);
  }
}
