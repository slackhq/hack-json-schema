<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\{C, Str};
use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\{FieldErrorCode, FieldErrorConstraint};
use type Slack\Hack\JsonSchema\Tests\Generated\ArraySchemaValidator;

final class ArraySchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('array-schema.json', 'ArraySchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testArrayOfStringsInvalidRoot(): void {
    $validator = new ArraySchemaValidator(varray['test', 'list', 'of', 'strings']);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testArrayOfStringsValid(): void {
    $validator = new ArraySchemaValidator(dict[
      'array_of_strings' => vec['test', 'list', 'of', 'strings'],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    expect(C\count($validated['array_of_strings'] ?? vec[]))->toBeSame(4);
  }

  public function testArrayOfStringsLegacyArrays(): void {
    $validator = new ArraySchemaValidator(darray['array_of_strings' => varray['test', 'list', 'of', 'strings']]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testArrayOfStringsLegacyAndHackArrays(): void {
    $validator = new ArraySchemaValidator(dict[
      'array_of_strings' => varray['test', 'list', 'of', 'strings'],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testDictOfStringsInvalid(): void {
    $validator = new ArraySchemaValidator(dict[
      'array_of_strings' => dict['test' => 'test'],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testCoerceArrayValidString(): void {
    $input = vec[1, 2, 3, 4];

    $validator = new ArraySchemaValidator(dict[
      'coerce_array' => \json_encode($input),
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();

    expect($validated)->toBeSame(shape('coerce_array' => $input));
  }

  public function testCoerceArrayInvalidString(): void {
    $input = vec[1, 2, 3, 'invalid'];

    $validator = new ArraySchemaValidator(dict[
      'coerce_array' => \json_encode($input),
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testCoerceArrayBadString(): void {
    $validator = new ArraySchemaValidator(dict[
      'coerce_array' => '{"test":',
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testCoerceArrayURLEncodedString(): void {
    $input = vec[1, 2, 3];

    $validator = new ArraySchemaValidator(dict[
      'coerce_array' => Str\join($input, ','),
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();

    expect($validated)->toBeSame(shape('coerce_array' => $input));
  }

  public function testCoerceArrayURLEncodedStringSingleValue(): void {
    $input = vec[1];

    $validator = new ArraySchemaValidator(dict[
      'coerce_array' => Str\join($input, ','),
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();

    expect($validated)->toBeSame(shape('coerce_array' => $input));
  }

  public function testUniqueItemsWithValidStrings(): void {
    $input = vec['a', 'b', 'c'];

    $validator = new ArraySchemaValidator(dict['unique_strings' => $input]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();

    expect($validated)->toBeSame(shape('unique_strings' => keyset($input)));
  }

  public function testUniqueItemsWithInvalidStrings(): void {
    $input = vec['a', 'b', 'a'];

    $validator = new ArraySchemaValidator(dict['unique_strings' => $input]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();

    $errors = $validator->getErrors();
    expect(C\count($errors))->toEqual(1);

    $error = C\firstx($errors);
    expect($error['code'])->toEqual(FieldErrorCode::FAILED_CONSTRAINT);
    expect($error['message'])->toEqual('Input contains duplicate items');

    $constraint = Shapes::at($error, 'constraint');
    expect($constraint['type'])->toEqual(FieldErrorConstraint::UNIQUE_ITEMS);
    expect($constraint['got'] ?? null)->toEqual($input);
  }

  public function testUniqueItemsWithValidNumbers(): void {
    $input = vec[1, 2, 3];

    $validator = new ArraySchemaValidator(dict['unique_numbers' => $input]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();

    expect($validated)->toBeSame(shape('unique_numbers' => keyset($input)));
  }

  public function testUniqueItemsWithInvalidNumbers(): void {
    $input = vec[1, 2, 1];

    $validator = new ArraySchemaValidator(dict['unique_numbers' => $input]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();

    $errors = $validator->getErrors();
    expect(C\count($errors))->toEqual(1);

    $error = C\firstx($errors);
    expect($error['code'])->toEqual(FieldErrorCode::FAILED_CONSTRAINT);
    expect($error['message'])->toEqual('Input contains duplicate items');

    $constraint = Shapes::at($error, 'constraint');
    expect($constraint['type'])->toEqual(FieldErrorConstraint::UNIQUE_ITEMS);
    expect($constraint['got'] ?? null)->toEqual($input);
  }

  public function testUniqueItemsWithCoercion(): void {
    $input = vec[1, 2, 1];

    $validator = new ArraySchemaValidator(dict['unique_numbers_coerce' => $input]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();

    expect($validated)->toEqual(shape('unique_numbers_coerce' => keyset($input)));
  }

  public function testUnsupportedUniqueItemsConstraint(): void {
    $input = vec[dict['foo' => 'a'], dict['foo' => 'a']];

    $validator = new ArraySchemaValidator(dict['unsupported_unique_items' => $input]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();

    expect($validated)->toEqual(shape('unsupported_unique_items' => vec[shape('foo' => 'a'), shape('foo' => 'a')]));
  }

}
