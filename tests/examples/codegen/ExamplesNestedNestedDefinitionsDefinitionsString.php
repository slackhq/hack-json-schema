<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<3de4bb1cb5c79f8e61a5b46565a3694a>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

<<Codegen>>
final class ExamplesNestedNestedDefinitionsDefinitionsString
  extends JsonSchema\BaseValidator<string> {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }

  final protected function process(): string {
    return self::check($this->input, $this->pointer);
  }
}
