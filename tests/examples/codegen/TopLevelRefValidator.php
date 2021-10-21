<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<db77db34bfb5521eb4c3610b70b0de73>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;

type TTopLevelRefValidator = string;

final class TopLevelRefValidator
  extends JsonSchema\BaseValidator<TTopLevelRefValidator> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TTopLevelRefValidator {
    return ExternalExamplesRefSchemaDefinitionsString::check($input, $pointer);
  }

  <<__Override>>
  protected function process(): TTopLevelRefValidator {
    return self::check($this->input, $this->pointer);
  }
}
