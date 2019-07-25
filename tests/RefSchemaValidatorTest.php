<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\RefSchemaValidator;

final class RefSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder(
      'ref-schema.json',
      'RefSchemaValidator',
      shape(
        'refs' => shape(
          'unique' => shape(
            'source_root' => __DIR__,
            'output_root' => __DIR__.'/examples/codegen',
          ),
        ),
      ),
    );
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testUniqueRefs(): void {
    $cases = vec[
      shape(
        'input' => ['remote-reference' => 'one'],
        'output' => ['remote-reference' => 'one'],
        'valid' => true,
      ),
      shape(
        'input' => ['remote-reference' => 5],
        'valid' => false,
      ),
      shape(
        'input' => [
          'duplicate-refs' => [
            'first' => ['string' => 'test', 'integer' => 5],
            'fourth' => ['string' => 'test', 'integer' => 5],
          ],
        ],
        'output' => [
          'duplicate-refs' => [
            'first' => ['string' => 'test', 'integer' => 5],
            'fourth' => ['string' => 'test', 'integer' => 5],
          ],
        ],
        'valid' => true,
      ),
      shape(
        'input' => ['remote-same-dir-reference' => 4],
        'output' => ['remote-same-dir-reference' => '4'],
        'valid' => true,
      ),
      shape(
        'input' => ['remote-nested-dir-reference' => 'test'],
        'output' => ['remote-nested-dir-reference' => 'test'],
        'valid' => true,
      ),
      shape(
        'input' => [
          'single-item-array-ref' => [
            ['string' => 'test', 'integer' => 5],
            ['string' => 'test2', 'integer' => 10],
          ],
        ],
        'output' => [
          'single-item-array-ref' => vec[
            ['string' => 'test', 'integer' => 5],
            ['string' => 'test2', 'integer' => 10],
          ],
        ],
        'valid' => true,
      ),
      shape(
        'input' => ['local-reference' => ['first' => 'test']],
        'output' => ['local-reference' => ['first' => 'test']],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new RefSchemaValidator($input));
  }

  public function testNullableUniqueRefNullValue(): void {
    $input = ['nullable-unique-ref' => null];

    $validator = new RefSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    $value = $validated['nullable-unique-ref'] ?? null;
    expect($value)->toBeNull();
  }

  public function testNullableUniqueRef(): void {
    $input = ['nullable-unique-ref' => ['integer' => 1, 'string' => 'string']];

    $validator = new RefSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    $value = $validated['nullable-unique-ref'] ?? null as nonnull;

    expect($value['string'] ?? '')->toBeSame('string');
    expect($value['integer'] ?? 0)->toBeSame(1);
  }

}
