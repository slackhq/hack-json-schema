<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<fe04a21fb75be07bc97e3ced3e05753a>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

<<Codegen>>
final class ExamplesPersonSchemaPropertiesAge
  extends JsonSchema\BaseValidator<int> {

  private static int $minimum = 0;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMinimumConstraint::check(
      $typed,
      self::$minimum,
      $pointer,
    );
    return $typed;
  }

  final protected function process(): int {
    return self::check($this->input, $this->pointer);
  }
}
