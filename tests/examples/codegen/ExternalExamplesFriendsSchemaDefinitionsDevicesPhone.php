<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<b6f0396986c08ef9d3d59e43be596fe9>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExternalExamplesFriendsSchemaDefinitionsDevicesPhone = shape(
  'model' => int,
  ?'carrier/provider' => string,
  ...
);

final class ExternalExamplesFriendsSchemaDefinitionsDevicesPhonePropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExternalExamplesFriendsSchemaDefinitionsDevicesPhonePropertiesCarrierNanProvider {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

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

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
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

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }

  <<__Override>>
  final protected function process(
  ): TExternalExamplesFriendsSchemaDefinitionsDevicesPhone {
    return self::check($this->input, $this->pointer);
  }
}
