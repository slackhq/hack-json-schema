<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<cc067497fb0720401aad87c0e7ffcb31>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExternalExamplesFriendsSchemaDefinitionsDevicesPhone = shape(
  'model' => int,
  ?'carrier/provider' => string,
  ...
);

<<Codegen>>
final class ExternalExamplesFriendsSchemaDefinitionsDevicesPhonePropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

<<Codegen>>
final class ExternalExamplesFriendsSchemaDefinitionsDevicesPhonePropertiesCarrierNanProvider {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

<<Codegen>>
final class ExternalExamplesFriendsSchemaDefinitionsDevicesPhone
  extends JsonSchema\BaseValidator<TExternalExamplesFriendsSchemaDefinitionsDevicesPhone> {

  private static keyset<string> $required = keyset[
    'model',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExternalExamplesFriendsSchemaDefinitionsDevicesPhone {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'model')) {
      try {
        $output['model'] = ExternalExamplesFriendsSchemaDefinitionsDevicesPhonePropertiesModel::check(
          $typed['model'],
          JsonSchema\get_pointer($pointer, 'model'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'carrier/provider')) {
      try {
        $output['carrier/provider'] = ExternalExamplesFriendsSchemaDefinitionsDevicesPhonePropertiesCarrierNanProvider::check(
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

    /* HH_IGNORE_ERROR[4057] */
    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }

  final protected function process(
  ): TExternalExamplesFriendsSchemaDefinitionsDevicesPhone {
    return self::check($this->input, $this->pointer);
  }
}
