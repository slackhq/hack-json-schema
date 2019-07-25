<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<fdabedf4f4e824c447f9410e4c8a4566>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TExamplesRefSchemaDefinitionsLocalObjectReference = shape(
  ?'first' => string,
  ...
);

<<Codegen>>
final class ExamplesRefSchemaDefinitionsLocalObjectReference
  extends JsonSchema\BaseValidator<TExamplesRefSchemaDefinitionsLocalObjectReference> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TExamplesRefSchemaDefinitionsLocalObjectReference {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = ExamplesRefSchemaDefinitionsLocalPropertyReference::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
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
  final protected function process(
  ): TExamplesRefSchemaDefinitionsLocalObjectReference {
    return self::check($this->input, $this->pointer);
  }
}
