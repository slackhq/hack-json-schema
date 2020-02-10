<?hh // partial

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;
use type Facebook\HackTest\DataProvider;
use namespace Slack\Hack\JsonSchema;

final class MultipleOfConstraintTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('multiple-of.json', 'MultipleOfValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function provideCasesForIsValid(
  ): dict<
    string,
    (shape(?'a_multiple_of_five_int' => int, ?'a_multiple_of_1_point_one_repeating_number' => num), bool),
  > {
    return dict[
      'zero is a multiple of 5' => tuple(shape('a_multiple_of_five_int' => 0), true),
      'one is not a multiple of 5' => tuple(shape('a_multiple_of_five_int' => 1), false),
      'five is a multiple of 5' => tuple(shape('a_multiple_of_five_int' => 5), true),
      'fifty is a multiple of 5' => tuple(shape('a_multiple_of_five_int' => 50), true),
      'zero is a mutliple of 1.1...' => tuple(shape('a_multiple_of_1_point_one_repeating_number' => 0), true),
      'one is not a mutliple of 1.1...' => tuple(shape('a_multiple_of_1_point_one_repeating_number' => 1), false),
      '5.5... is a multiple of 1.1...' =>
        // This will have an modulus of 1.1111111111056, testing if I can deal with it being slightly below the devidor.
        tuple(shape('a_multiple_of_1_point_one_repeating_number' => 5.55555555555), true),
      '5.5...6 is a multiple of 1.1... if you place the 6 far enough back' =>
        // This will have an modulus of 4.4444449986969E-7, testing if I can deal with it being slightly above zero.
        tuple(shape('a_multiple_of_1_point_one_repeating_number' => 5.555556), true),
      '5555555.5... is a multiple of 1.1...' =>
        tuple(shape('a_multiple_of_1_point_one_repeating_number' => 55555555.55555555555), true),
      // I arbitrarily choose to check for 6 digits. These tests need updating if we choose a different number of digits.
      '1.11111 <- 5 times a one behind the period is a multiple of 1.1...' =>
        tuple(shape('a_multiple_of_1_point_one_repeating_number' => 1.11111), false),
      '1.111111 <- 6 times a one behind the period is a multiple of 1.1...' =>
        tuple(shape('a_multiple_of_1_point_one_repeating_number' => 1.111111), true),
    ];
  }

  <<DataProvider('provideCasesForIsValid')>>
  public function testIsValid(shape(...) $value, bool $is_valid): void {
    $schema = new Generated\MultipleOfValidator($value);
    $schema->validate();
    expect($schema->isValid())->toBeSame($is_valid);
  }

  public function testForError(): void {
    $schema = new Generated\MultipleOfValidator(shape('a_multiple_of_five_int' => 1));
    $schema->validate();
    $err = $schema->getErrors()[0];
    expect(Shapes::idx($err, 'constraint')as nonnull['type'])->toBeSame(JsonSchema\FieldErrorConstraint::MULTIPLE_OF);
    expect(Shapes::idx($err, 'constraint') |> Shapes::idx($$ as nonnull, 'got'))->toBeSame(1);
    expect(Shapes::idx($err, 'constraint') |> Shapes::idx($$ as nonnull, 'expected'))->toBeSame(5);
    expect($err['message'])->toBeSame('must be a multiple of 5');
  }

}
