<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<f57a9080fda14e4ed995266ea7ae4d40>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TIgnoreRefsValidatorPropertiesRandomprop = mixed;

type TIgnoreRefsValidator = shape(
  ?'randomprop' => TIgnoreRefsValidatorPropertiesRandomprop,
  ...
);

final class IgnoreRefsValidatorPropertiesRandomprop {

  public static function check(
    mixed $input,
    string $_pointer,
  ): TIgnoreRefsValidatorPropertiesRandomprop {
    return $input;
  }
}

final class IgnoreRefsValidator
  extends JsonSchema\BaseValidator<TIgnoreRefsValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TIgnoreRefsValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'randomprop')) {
      try {
        $output['randomprop'] = IgnoreRefsValidatorPropertiesRandomprop::check(
          $typed['randomprop'],
          JsonSchema\get_pointer($pointer, 'randomprop'),
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
  protected function process(): TIgnoreRefsValidator {
    return self::check($this->input, $this->pointer);
  }
}
