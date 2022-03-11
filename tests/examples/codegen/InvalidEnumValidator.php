<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<d0e6696a67f3635520d567e0bb3f5348>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

final class InvalidEnumValidator
  extends JsonSchema\BaseValidator<\Slack\Hack\JsonSchema\Tests\TestIntEnum> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): \Slack\Hack\JsonSchema\Tests\TestIntEnum {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    $typed = Constraints\HackEnumConstraint::check(
      $typed,
      \Slack\Hack\JsonSchema\Tests\TestIntEnum::class,
      $pointer,
    );
    return $typed;
  }

  <<__Override>>
  protected function process(): \Slack\Hack\JsonSchema\Tests\TestIntEnum {
    return self::check($this->input, $this->pointer);
  }
}
