<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<a8bd0f55de9841e817cf3ee88f13c604>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;

type TExternalExamplesRefSchema = mixed;

<<Codegen>>
final class ExternalExamplesRefSchema
  extends JsonSchema\BaseValidator<TExternalExamplesRefSchema> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TExternalExamplesRefSchema {
  }

  final protected function process(): TExternalExamplesRefSchema {
    return self::check($this->input, $this->pointer);
  }
}
