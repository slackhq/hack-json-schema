<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<4671726aa3c6b380ea01d02c4e70713e>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;

type TExternalExamplesRefSchema = mixed;

final class ExternalExamplesRefSchema
  extends JsonSchema\BaseValidator<TExternalExamplesRefSchema> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TExternalExamplesRefSchema {
    return $input;
  }

  <<__Override>>
  final protected function process(): TExternalExamplesRefSchema {
    return self::check($this->input, $this->pointer);
  }
}
