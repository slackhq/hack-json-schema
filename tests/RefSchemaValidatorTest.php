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
        'input' => darray['remote-reference' => 'one'],
        'output' => darray['remote-reference' => 'one'],
        'valid' => true,
      ),
      shape(
        'input' => darray['remote-reference' => 5],
        'valid' => false,
      ),
      shape(
        'input' => darray[
          'duplicate-refs' => darray[
            'first' => darray['string' => 'test', 'integer' => 5],
            'fourth' => darray['string' => 'test', 'integer' => 5],
          ],
        ],
        'output' => darray[
          'duplicate-refs' => darray[
            'first' => darray['string' => 'test', 'integer' => 5],
            'fourth' => darray['string' => 'test', 'integer' => 5],
          ],
        ],
        'valid' => true,
      ),
      shape(
        'input' => darray['remote-same-dir-reference' => 4],
        'output' => darray['remote-same-dir-reference' => '4'],
        'valid' => true,
      ),
      shape(
        'input' => darray['remote-nested-dir-reference' => 'test'],
        'output' => darray['remote-nested-dir-reference' => 'test'],
        'valid' => true,
      ),
      shape(
        'input' => darray[
          'single-item-array-ref' => varray[
            darray['string' => 'test', 'integer' => 5],
            darray['string' => 'test2', 'integer' => 10],
          ],
        ],
        'output' => darray[
          'single-item-array-ref' => vec[
            darray['string' => 'test', 'integer' => 5],
            darray['string' => 'test2', 'integer' => 10],
          ],
        ],
        'valid' => true,
      ),
      shape(
        'input' => darray['local-reference' => darray['first' => 'test']],
        'output' => darray['local-reference' => darray['first' => 'test']],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new RefSchemaValidator($input));
  }

  public function testNullableUniqueRefNullValue(): void {
    $input = darray['nullable-unique-ref' => null];

    $validator = new RefSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    $value = $validated['nullable-unique-ref'] ?? null;
    expect($value)->toBeNull();
  }

  public function testNullableUniqueRef(): void {
    $input = darray['nullable-unique-ref' => darray['integer' => 1, 'string' => 'string']];

    $validator = new RefSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    $value = $validated['nullable-unique-ref'] ?? null as nonnull;

    expect($value['string'] ?? '')->toBeSame('string');
    expect($value['integer'] ?? 0)->toBeSame(1);
  }

}
