<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<2dd9b05b0b8085182489f4d37c4e8024>>
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
  protected function process(): TExternalExamplesRefSchema {
    return self::check($this->input, $this->pointer);
  }
}
