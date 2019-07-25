<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<6d1fd6561cd1fc5e89265211e0917079>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;

type TExternalExamplesRefSchema = mixed;

final class ExternalExamplesRefSchema
  extends JsonSchema\BaseValidator<TExternalExamplesRefSchema> {

  public static function check(
    mixed $input,
    string $_pointer,
  ): TExternalExamplesRefSchema {
    return $input;
  }

  <<__Override>>
  final protected function process(): TExternalExamplesRefSchema {
    return self::check($this->input, $this->pointer);
  }
}
