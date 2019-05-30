<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<e4e42d0b2db2e4ca2fc3ca407d3fb9fa>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

<<Codegen>>
final class ExamplesStringSchemaDefinitionsCoerce
  extends JsonSchema\BaseValidator<string> {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }

  final protected function process(): string {
    return self::check($this->input, $this->pointer);
  }
}
