<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<87099fa7ab53b7c10956fe5253b4fa23>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExternalExamplesExternalDefinitionsPerson = shape(
  ?'nickname' => string,
  ...
);

final class ExternalExamplesExternalDefinitionsPerson
  extends JsonSchema\BaseValidator<TExternalExamplesExternalDefinitionsPerson> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExternalExamplesExternalDefinitionsPerson {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'nickname')) {
      try {
        $output['nickname'] = ExternalExamplesExternalDefinitionsNickname::check(
          $typed['nickname'],
          JsonSchema\get_pointer($pointer, 'nickname'),
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
  protected function process(): TExternalExamplesExternalDefinitionsPerson {
    return self::check($this->input, $this->pointer);
  }
}
