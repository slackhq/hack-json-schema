<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<fdde5531754bf0dd223af9534e8233a2>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

final class ExamplesStringSchemaDefinitionsCoerce
  extends JsonSchema\BaseValidator<string> {

  private static bool $coerce = true;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }

  <<__Override>>
  protected function process(): string {
    return self::check($this->input, $this->pointer);
  }
}
