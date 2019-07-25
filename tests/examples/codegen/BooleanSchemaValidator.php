<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<102e412d69b1d57b343e20bc5fa8ec6a>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TBooleanSchemaValidator = shape(
  ?'simple' => bool,
  ?'coerce' => bool,
  ...
);

final class BooleanSchemaValidatorPropertiesSimple {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class BooleanSchemaValidatorPropertiesCoerce {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): bool {
    $typed =
      Constraints\BooleanConstraint::check($input, $pointer, self::$coerce);
    return $typed;
  }
}

final class BooleanSchemaValidator
  extends JsonSchema\BaseValidator<TBooleanSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TBooleanSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'simple')) {
      try {
        $output['simple'] = BooleanSchemaValidatorPropertiesSimple::check(
          $typed['simple'],
          JsonSchema\get_pointer($pointer, 'simple'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'coerce')) {
      try {
        $output['coerce'] = BooleanSchemaValidatorPropertiesCoerce::check(
          $typed['coerce'],
          JsonSchema\get_pointer($pointer, 'coerce'),
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

  <<__Override>>
  final protected function process(): TBooleanSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
