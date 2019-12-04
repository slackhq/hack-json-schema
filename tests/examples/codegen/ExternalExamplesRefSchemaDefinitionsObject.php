<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<dc661922ac4247a1d75be6c7977aa8a8>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExternalExamplesRefSchemaDefinitionsObject = shape(
  ?'string' => string,
  ?'integer' => int,
  ...
);

final class ExternalExamplesRefSchemaDefinitionsObjectPropertiesString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExternalExamplesRefSchemaDefinitionsObjectPropertiesInteger {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExternalExamplesRefSchemaDefinitionsObject
  extends JsonSchema\BaseValidator<TExternalExamplesRefSchemaDefinitionsObject> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExternalExamplesRefSchemaDefinitionsObject {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'string')) {
      try {
        $output['string'] = ExternalExamplesRefSchemaDefinitionsObjectPropertiesString::check(
          $typed['string'],
          JsonSchema\get_pointer($pointer, 'string'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'integer')) {
      try {
        $output['integer'] = ExternalExamplesRefSchemaDefinitionsObjectPropertiesInteger::check(
          $typed['integer'],
          JsonSchema\get_pointer($pointer, 'integer'),
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
  ): TExternalExamplesRefSchemaDefinitionsObject {
    return self::check($this->input, $this->pointer);
  }
}
