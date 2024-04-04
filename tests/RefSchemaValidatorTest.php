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
        'input' => dict['remote-reference' => 'one'],
        'output' => dict['remote-reference' => 'one'],
        'valid' => true,
      ),
      shape(
        'input' => dict['remote-reference' => 5],
        'valid' => false,
      ),
      shape(
        'input' => dict[
          'duplicate-refs' => dict[
            'first' => dict['string' => 'test', 'integer' => 5],
            'fourth' => dict['string' => 'test', 'integer' => 5],
          ],
        ],
        'output' => dict[
          'duplicate-refs' => dict[
            'first' => dict['string' => 'test', 'integer' => 5],
            'fourth' => dict['string' => 'test', 'integer' => 5],
          ],
        ],
        'valid' => true,
      ),
      shape(
        'input' => dict['remote-same-dir-reference' => 4],
        'output' => dict['remote-same-dir-reference' => '4'],
        'valid' => true,
      ),
      shape(
        'input' => dict['remote-nested-dir-reference' => 'test'],
        'output' => dict['remote-nested-dir-reference' => 'test'],
        'valid' => true,
      ),
      shape(
        'input' => dict[
          'single-item-array-ref' => varray[
            dict['string' => 'test', 'integer' => 5],
            dict['string' => 'test2', 'integer' => 10],
          ],
        ],
        'output' => dict[
          'single-item-array-ref' => vec[
            dict['string' => 'test', 'integer' => 5],
            dict['string' => 'test2', 'integer' => 10],
          ],
        ],
        'valid' => true,
      ),
      shape(
        'input' => dict['local-reference' => dict['first' => 'test']],
        'output' => dict['local-reference' => dict['first' => 'test']],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new RefSchemaValidator($input));
  }

  public function testNullableUniqueRefNullValue(): void {
    $input = dict['nullable-unique-ref' => null];

    $validator = new RefSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    $value = $validated['nullable-unique-ref'] ?? null;
    expect($value)->toBeNull();
  }

  public function testNullableUniqueRef(): void {
    $input = dict['nullable-unique-ref' => dict['integer' => 1, 'string' => 'string']];

    $validator = new RefSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    $value = $validated['nullable-unique-ref'] ?? null as nonnull;

    expect($value['string'] ?? '')->toBeSame('string');
    expect($value['integer'] ?? 0)->toBeSame(1);
  }

  public function testCoerceObjectRef(): void {
    $input = dict['coerce-object-ref' => \json_encode(dict['string' => 'aaa', 'integer' => 123])];

    $validator = new RefSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
    $validated = $validator->getValidatedInput();
    $value = $validated['coerce-object-ref'] ?? null as nonnull;

    expect($value['string'] ?? '')->toBeSame('aaa');
    expect($value['integer'] ?? 0)->toBeSame(123);
  }
}
