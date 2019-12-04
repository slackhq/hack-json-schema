<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<a06236bacc76b44e8e8625d3ff26d071>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;

type TEmptySchemaValidator = mixed;

final class EmptySchemaValidator
  extends JsonSchema\BaseValidator<TEmptySchemaValidator> {

  public static function check(
    mixed $input,
    string $_pointer,
  ): TEmptySchemaValidator {
    return $input;
  }

  <<__Override>>
  protected function process(): TEmptySchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
