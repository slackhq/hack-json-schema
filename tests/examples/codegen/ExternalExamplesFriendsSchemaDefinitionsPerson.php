<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<c8d6a2c4def197e887e91069d7e72469>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExternalExamplesFriendsSchemaDefinitionsPerson = shape(
  'first_name' => string,
  'last_name' => string,
  ?'age' => int,
  ?'~devices/' => vec<TExternalExamplesFriendsSchemaDefinitionsDevicesPhone>,
  ...
);

final class ExternalExamplesFriendsSchemaDefinitionsPersonPropertiesFirstName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExternalExamplesFriendsSchemaDefinitionsPersonPropertiesLastName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExternalExamplesFriendsSchemaDefinitionsPersonPropertiesNanDevicesNan {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TExternalExamplesFriendsSchemaDefinitionsDevicesPhone> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExternalExamplesFriendsSchemaDefinitionsDevicesPhone::check(
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

final class ExternalExamplesFriendsSchemaDefinitionsPerson
  extends JsonSchema\BaseValidator<TExternalExamplesFriendsSchemaDefinitionsPerson> {

  private static keyset<string> $required = keyset[
    'first_name',
    'last_name',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExternalExamplesFriendsSchemaDefinitionsPerson {
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
        $output['first_name'] = ExternalExamplesFriendsSchemaDefinitionsPersonPropertiesFirstName::check(
          $typed['first_name'],
          JsonSchema\get_pointer($pointer, 'first_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'last_name')) {
      try {
        $output['last_name'] = ExternalExamplesFriendsSchemaDefinitionsPersonPropertiesLastName::check(
          $typed['last_name'],
          JsonSchema\get_pointer($pointer, 'last_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = ExamplesPersonSchemaPropertiesAge::check(
          $typed['age'],
          JsonSchema\get_pointer($pointer, 'age'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, '~devices/')) {
      try {
        $output['~devices/'] = ExternalExamplesFriendsSchemaDefinitionsPersonPropertiesNanDevicesNan::check(
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

  <<__Override>>
  final protected function process(
  ): TExternalExamplesFriendsSchemaDefinitionsPerson {
    return self::check($this->input, $this->pointer);
  }
}
