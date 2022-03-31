<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<def8fad35757eca21df7d34cd0b8736b>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;

type TTopLevelRefValidator = TExamplesNumericalSchema;

final class TopLevelRefValidator
  extends JsonSchema\BaseValidator<TExamplesNumericalSchema> {

  <<__Override>>
  protected function process(): TExamplesNumericalSchema {
    return ExamplesNumericalSchema::check($this->input, $this->pointer);
  }
}
