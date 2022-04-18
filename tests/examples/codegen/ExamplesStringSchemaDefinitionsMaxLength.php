<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<9a35e3e56999e3ff00ca81b81e7d0c14>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

final class ExamplesStringSchemaDefinitionsMaxLength
  extends JsonSchema\BaseValidator<string> {

  private static int $maxLength = 10;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $length = \mb_strlen($typed);
    Constraints\StringMaxLengthConstraint::check(
      $length,
      self::$maxLength,
      $pointer,
    );
    return $typed;
  }

  <<__Override>>
  protected function process(): string {
    return self::check($this->input, $this->pointer);
  }
}
