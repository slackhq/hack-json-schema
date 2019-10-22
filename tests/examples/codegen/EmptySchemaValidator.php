<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<2b882ea226bfc16e6b2fe5cb2c2219cf>>
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
  final protected function process(): TEmptySchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
