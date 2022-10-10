<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\{C, Str};
use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\UntypedSchemaValidator;
use namespace Slack\Hack\JsonSchema\Codegen;

function _untyped_schema_validator_test_uniline(string $input): string {
  return $input
    |> Str\replace($$, ' ', '_')
    |> Str\replace($$, "\n", ' ');
}

function _untyped_schema_validator_test_multiline(string $input): string {
  return $input
    |> Str\replace($$, ' ', '_');
}

final class UntypedSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder(
      'untyped-schema.json',
      'UntypedSchemaValidator',
      shape(
        'sanitize_string' => shape(
          'uniline' => _untyped_schema_validator_test_uniline<>,
          'multiline' => _untyped_schema_validator_test_multiline<>,
        ),
        'defaults' => shape('coerce' => true),
      ),
    );
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testUntypedGeneratesType(): void {
    $input = dict[
      'any_of' => 'valid',
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    $validated_input = $validator->getValidatedInput();
    $any_of = ($validated_input['any_of'] ?? null) as nonnull;

    Codegen\type_assert_shape($any_of, 'Slack\Hack\JsonSchema\Tests\Generated\TUntypedSchemaValidatorPropertiesAnyOf');
  }

  public function testAllOf(): void {
    $input = dict[
      'all_of' => 3.0,
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    expect(C\count($validator->getErrors()))->toBeSame(3, 'output all errors');
  }

  public function testAnyOf(): void {
    $input = dict[
      'any_of' => 3.0,
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    expect(C\count($validator->getErrors()))->toBeSame(3, 'output all errors');
  }

  public function testAllOfPassThrough(): void {
    $input = dict[
      'all_of_pass_through' => "some\nmultiline\nstring",
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    expect($validated['all_of_pass_through'] ?? null)->toBeSame('some multiline string');
  }

  public function testAllOfPassThroughSecondSchemaMutates(): void {
    $input = dict[
      'all_of_pass_through_second' => "some\nmultiline\nstring",
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    expect($validated['all_of_pass_through_second'] ?? null)->toBeSame('some multiline string');
  }

  public function testAllOfCoerce(): void {
    $input = dict[
      'all_of_coerce' => \json_encode(dict['property' => 'string value']),
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    expect($validated['all_of_coerce'] ?? null)->toBeSame(shape('property' => 'string value'));
  }

  public function testAllOfDefault(): void {
    $input = dict[
      'all_of_default' => dict[],
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    expect($validated['all_of_default'] ?? null)->toBeSame(shape('numerical_property' => 0, 'property' => 'default'));
  }

  public function testAllOfDefaultFirstSchemaWins(): void {
    $input = dict[
      'all_of_default_first_schema_wins' => dict[],
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    expect($validated['all_of_default_first_schema_wins'] ?? null)
      ->toBeSame(shape('property' => 'actual_default'));
  }

  public function testAnyOfOptimizedEnumValid(): void {
    $input = dict[
      'any_of_optimized_enum' => dict[
        'type' => 'first',
        'string' => 'something',
      ],
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    expect($validated['any_of_optimized_enum'] ?? null)
      ->toBeSame(shape('type' => 'first', 'string' => 'something'));
  }

  public function testAnyOfOptimizedEnumInvalid(): void {
    $input = dict[
      'any_of_optimized_enum' => dict[
        'type' => 'first',
        'integer' => 3,
      ],
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();
  }

  public function testAnyOfOptimizedEnumInvalidType(): void {
    $input = dict[
      'any_of_optimized_enum' => dict[
        'type' => null,
        'integer' => 3,
      ],
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    $errors = $validator->getErrors();
    expect(C\count($errors))->toBeSame(1);
    $error = $errors[0];
    expect($error['code'])->toBeSame('invalid_type');
    expect($error['message'])->toBeSame('must provide a string');
    expect($error['pointer'] ?? null)->toBeSame('/any_of_optimized_enum/type');
  }

  public function testAnyOfOptimizedEnumCoercionInvalid(): void {
    $input = dict[
      'any_of_optimized_enum' => \json_encode(dict[
        'type' => 'first',
        'string' => 'something',
      ]),
    ];

    $validator = new UntypedSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    $errors = $validator->getErrors();
    expect(C\count($errors))->toBeSame(1);
    $error = $errors[0];
    expect($error['code'])->toBeSame('invalid_type');
    expect($error['message'])->toBeSame('must provide an object');
    expect($error['pointer'] ?? null)->toBeSame('/any_of_optimized_enum');
  }

  public function testOneOfNullableString(): void {
    $this->expectCases(
      vec[
        shape('input' => 'foo', 'output' => dict['one_of_nullable_string' => 'foo'], 'valid' => true),
        shape('input' => null, 'output' => dict['one_of_nullable_string' => null], 'valid' => true),
        shape('input' => true, 'valid' => false),
      ],
      $input ==> new UntypedSchemaValidator(dict['one_of_nullable_string' => $input]),
    );
  }

  public function testOneOfStringAndInt(): void {
    $this->expectCases(
      vec[
        shape('input' => 'foo', 'output' => dict['one_of_string_and_int' => 'foo'], 'valid' => true),
        shape('input' => 3, 'output' => dict['one_of_string_and_int' => 3], 'valid' => true),
        shape('input' => true, 'valid' => false),
      ],
      $input ==> new UntypedSchemaValidator(dict['one_of_string_and_int' => $input]),
    );
  }

  public function testOneOfStringAndVec(): void {
    $this->expectCases(
      vec[
        shape('input' => 'foo', 'output' => dict['one_of_string_and_vec' => 'foo'], 'valid' => true),
        shape('input' => vec[3], 'output' => dict['one_of_string_and_vec' => vec[3]], 'valid' => true),
        shape('input' => 3, 'valid' => false),
      ],
      $input ==> new UntypedSchemaValidator(dict['one_of_string_and_vec' => $input]),
    );
  }
}
