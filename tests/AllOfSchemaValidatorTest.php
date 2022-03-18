<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;
use namespace HH\Lib\{C, Dict, Keyset};

use type Slack\Hack\JsonSchema\BaseValidator;
use type Slack\Hack\JsonSchema\Tests\Generated\{ExamplesAllofSchema1, ExamplesAllofSchema2};

final class AllOfSchemaValidatorTest extends BaseCodegenTestCase {

  const dict<string, mixed> EXPECTED_ALL_OF_SCHEMA_1_VALID_INPUT = dict[
    'foo' => 0,
    'bar' => 10,
  ];

  const dict<string, mixed> EXPECTED_ALL_OF_SCHEMA_2_VALID_INPUT = dict[
    'foo' => 0,
    'bar' => 10,
    'baz' => 3,
    'nickname' => 'tom',
    'simple_object_prop_1' => -50,
    'xs' => vec[
      dict[
        'bar' => 10,
        'foo' => 0,
        'qux' => -50,
      ],
    ],
  ];

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $config = shape(
      'refs' => shape(
        'unique' => shape(
          'source_root' => __DIR__,
          'output_root' => __DIR__.'/examples/codegen',
        ),
      ),
    );
    $ret = self::getBuilder('allof-schema-1.json', 'ExamplesAllofSchema1', $config);
    $ret['codegen']->build();
    $ret = self::getBuilder('allof-schema-2.json', 'ExamplesAllofSchema2', $config);
    $ret['codegen']->build();
  }

  private function assertValidInput<T>(classname<BaseValidator<T>> $validator, dict<string, mixed> $input): void {
    $validator = new $validator($input);
    $validator->validate();
    expect($validator->isValid())->toBeTrue();
  }

  private function assertInvalidInput<T>(
    classname<BaseValidator<T>> $validator,
    dict<string, mixed> $valid_input,
    vec<(string, mixed)> $invalid_inputs,
  ): void {
    foreach ($invalid_inputs as $invalid_input) {
      $input = Dict\map($valid_input, $_ ==> $_);
      list($k, $v) = $invalid_input;
      $input[$k] = $v;

      $validator = new $validator($input);
      $validator->validate();
      expect($validator->isValid())->toBeFalse();

      $errors = $validator->getErrors();
      expect(C\count($errors))->toEqual(1);
      expect(C\first($errors)['pointer'] ?? '')->toContainSubstring($k);
    }
  }

  private function assertMissingFields<T>(
    classname<BaseValidator<T>> $validator,
    dict<string, mixed> $valid_input,
  ): void {
    $fields = Keyset\keys($valid_input);
    foreach ($fields as $field) {
      $input = Dict\filter_keys(self::EXPECTED_ALL_OF_SCHEMA_2_VALID_INPUT, $k ==> $k !== $field);

      $validator = new ExamplesAllofSchema2($input);
      $validator->validate();
      expect($validator->isValid())->toBeFalse();

      $errors = $validator->getErrors();
      expect(C\count($errors))->toEqual(1);
    }
  }

  public function testExamplesAllofSchema1ValidInput(): void {
    $this->assertValidInput(ExamplesAllofSchema1::class, $this::EXPECTED_ALL_OF_SCHEMA_1_VALID_INPUT);
  }

  public function testExamplesAllofSchema1InvalidInput(): void {
    $this->assertInvalidInput(
      ExamplesAllofSchema1::class,
      $this::EXPECTED_ALL_OF_SCHEMA_1_VALID_INPUT,
      vec[
        tuple('foo', -1),
        tuple('foo', ''),
        tuple('bar', 11),
        tuple('bar', ''),
      ],
    );
  }

  public function testExamplesAllofSchema1MissingFields(): void {
    $this->assertMissingFields(ExamplesAllofSchema1::class, $this::EXPECTED_ALL_OF_SCHEMA_1_VALID_INPUT);
  }

  public function testExamplesAllofSchema2ValidInput(): void {
    $this->assertValidInput(ExamplesAllofSchema2::class, $this::EXPECTED_ALL_OF_SCHEMA_2_VALID_INPUT);
  }

  public function testExamplesAllofSchema2InvalidInput(): void {
    $this->assertInvalidInput(
      ExamplesAllofSchema2::class,
      $this::EXPECTED_ALL_OF_SCHEMA_2_VALID_INPUT,
      vec[
        tuple('foo', -1),
        tuple('foo', ''),
        tuple('bar', 11),
        tuple('bar', ''),
        tuple('baz', 4),
        tuple('nickname', 1),
        tuple('simple_object_prop_1', 'foo'),
        tuple('simple_object_prop_2', 'bar'),
        tuple('simple_object_prop_2', dict[]),
        tuple('simple_object_prop_2', dict[
          'prop_2' => 3,
        ]),
        tuple('simple_object_prop_2', dict[
          'prop_1' => 'foo',
        ]),
        tuple('xs', vec[
          dict[
            'bar' => 11,
            'foo' => 0,
            'qux' => -50,
          ],
        ]),
      ],
    );
  }

  public function testExamplesAllofSchema2MissingFields(): void {
    $this->assertMissingFields(ExamplesAllofSchema2::class, $this::EXPECTED_ALL_OF_SCHEMA_2_VALID_INPUT);
  }
}
