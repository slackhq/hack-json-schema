<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<214fa349a375ac286d982de8236d3e89>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExternalExamplesSimple = shape(
  ?'a' => string,
  ...
);

final class ExternalExamplesSimplePropertiesA {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class ExternalExamplesSimple
  extends JsonSchema\BaseValidator<TExternalExamplesSimple> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExternalExamplesSimple {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'a')) {
      try {
        $output['a'] = ExternalExamplesSimplePropertiesA::check(
          $typed['a'],
          JsonSchema\get_pointer($pointer, 'a'),
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
  protected function process(): TExternalExamplesSimple {
    return self::check($this->input, $this->pointer);
  }
}
