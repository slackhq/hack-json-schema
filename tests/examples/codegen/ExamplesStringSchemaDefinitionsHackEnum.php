<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<f5a043eba14cf8234dc6d98904607c0d>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

final class ExamplesStringSchemaDefinitionsHackEnum
  extends JsonSchema\BaseValidator<\Slack\Hack\JsonSchema\Tests\TestStringEnum> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): \Slack\Hack\JsonSchema\Tests\TestStringEnum {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $typed = Constraints\HackEnumConstraint::check(
      $typed,
      \Slack\Hack\JsonSchema\Tests\TestStringEnum::class,
      $pointer,
    );
    return $typed;
  }

  <<__Override>>
  protected function process(): \Slack\Hack\JsonSchema\Tests\TestStringEnum {
    return self::check($this->input, $this->pointer);
  }
}
