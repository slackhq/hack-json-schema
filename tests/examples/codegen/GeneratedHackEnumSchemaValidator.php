<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<ff65e010c6ed29ad1f95451eac4f8a17>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TGeneratedHackEnumSchemaValidator = shape(
  ?'enum_string' => myCoolTestEnum,
  ...
);


enum myCoolTestEnum : string as string {
  ONE = 'one';
  TWO = 'two';
  THREE = 'three';
}

final class GeneratedHackEnumSchemaValidatorPropertiesEnumString {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): myCoolTestEnum {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $typed = Constraints\HackEnumConstraint::check(
      $typed,
      myCoolTestEnum::class,
      $pointer,
    );
    return $typed;
  }
}

final class GeneratedHackEnumSchemaValidator
  extends JsonSchema\BaseValidator<TGeneratedHackEnumSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TGeneratedHackEnumSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'enum_string')) {
      try {
        $output['enum_string'] = GeneratedHackEnumSchemaValidatorPropertiesEnumString::check(
          $typed['enum_string'],
          JsonSchema\get_pointer($pointer, 'enum_string'),
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
  protected function process(): TGeneratedHackEnumSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
