<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<0b96e941444beee4bf19de7c50636410>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

final class ExternalExamplesRefSchemaDefinitionsString
  extends JsonSchema\BaseValidator<string> {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }

  <<__Override>>
  final protected function process(): string {
    return self::check($this->input, $this->pointer);
  }
}
