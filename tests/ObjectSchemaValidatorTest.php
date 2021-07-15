<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\C;
use namespace Slack\Hack\JsonSchema;
use namespace Facebook\TypeAssert;
use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\ObjectSchemaValidator;

final class ObjectSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('object-schema.json', 'ObjectSchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testCustomRootPointer(): void {
    $validator = new ObjectSchemaValidator(
      dict[
        'only_properties' => dict[
          'string' => 3,
        ],
      ],
      JsonSchema\get_pointer('', 'custom', 'root'),
    );

    $validator->validate();
    expect($validator->isValid())->toBeFalse();

    $error = $validator->getErrors()[0];
    expect($error['pointer'] ?? '')->toBeSame('/custom/root/only_properties/string');
  }

  public function testOnlyPropertiesDefaultStrings(): void {
    $validator = new ObjectSchemaValidator(dict[
      'only_properties' => dict[],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    $default = $validated['only_properties'] ?? null as nonnull;

    expect($default['required_string'])->toBeSame('required_default');
    expect($default['string'] ?? null)->toBeSame('optional_default');
    expect($default['number'] ?? null)->toBeSame(3);
  }

  public function testOnlyPropertiesDefaultDontOverride(): void {
    $validator = new ObjectSchemaValidator(dict[
      'only_properties' => dict[
        'string' => 'optional value',
        'required_string' => 'required value',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    $default = $validated['only_properties'] ?? null as nonnull;

    expect($default['required_string'])->toBeSame('required value');
    expect($default['string'] ?? null)->toBeSame('optional value');
  }

  public function testOnlyAdditionalPropertiesValid(): void {
    $validator = new ObjectSchemaValidator(dict[
      'only_additional_properties' => dict[
        'value' => 'string',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();
  }

  public function testOnlyNoAdditionalPropertiesInvalid(): void {
    $validator = new ObjectSchemaValidator(dict[
      'only_no_additional_properties' => dict[
        'value' => 'string',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
  }

  public function testSinglePatternProperty(): void {
    $validator = new ObjectSchemaValidator(dict[
      'single_pattern_property_string' => dict[
        'S_string_value' => 'string value',
        'I_number_value' => 12,
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    expect($validated['single_pattern_property_string'] ?? null)->toBeSame(dict['S_string_value' => 'string value']);
  }

  public function testSinglePatternPropertyObject(): void {
    $validator = new ObjectSchemaValidator(dict[
      'single_pattern_property_object' => dict[
        'S_string_value' => dict[
          'sample' => 'test',
        ],
        'I_number_value' => 12,
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    $property = $validated['single_pattern_property_object'] ?? null as nonnull;
    expect($property['S_string_value']['sample'])->toBeSame('test');
  }

  public function testOnlyPatternPropertiesValid(): void {
    $validator = new ObjectSchemaValidator(dict[
      'only_pattern_properties' => dict[
        'S_string_value' => 'string value',
        'I_number_value' => 12,
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    $only_pattern_properties = $validated['only_pattern_properties'] ?? null;
    expect($only_pattern_properties)->toBeSame(dict[
      'S_string_value' => 'string value',
      'I_number_value' => 12,
    ]);
  }

  public function testOnlyPatternPropertiesInvalid(): void {
    $validator = new ObjectSchemaValidator(dict[
      'only_pattern_properties' => dict[
        'S_string_value' => 12,
        'I_number_value' => 'string value',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(2);
  }

  public function testOnlyPatternPropertiesAllowAdditional(): void {
    $validator = new ObjectSchemaValidator(dict[
      'only_pattern_properties' => dict[
        'S_string_value' => 'string value',
        'I_number_value' => 12,
        'additional_value' => 'test',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();

    $only_pattern_properties = $validated['only_pattern_properties'] ?? null;
    expect($only_pattern_properties)->toBeSame(dict[
      'S_string_value' => 'string value',
      'I_number_value' => 12,
    ]);
  }

  public function testPatternPropertiesNoAdditional(): void {
    $validator = new ObjectSchemaValidator(dict[
      'pattern_properties_no_additional_properties' => dict[
        'S_string_value' => 'string value',
        'I_number_value' => 12,
        'additional_value' => 'test',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(1);
  }

  public function testPatternPropertiesInvalidNoAdditional(): void {
    $validator = new ObjectSchemaValidator(dict[
      'pattern_properties_no_additional_properties' => dict[
        'S_string_value' => 12,
        'additional_value' => 'test',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(2);
  }

  public function testPropertiesAndPatternPropertiesValid(): void {
    $validator = new ObjectSchemaValidator(dict[
      'properties_and_pattern_properties' => dict[
        'string' => 'some string value',
        'S_string_value' => 'string value',
        'I_number_value' => 12,
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    expect($validated['properties_and_pattern_properties'] ?? null)->toBeSame(
      shape(
        'string' => 'some string value',
        'S_string_value' => 'string value',
        'I_number_value' => 12,
      ),
    );
  }

  public function testPropertiesAndPatternPropertiesInvalidPatterns(): void {
    $validator = new ObjectSchemaValidator(dict[
      'properties_and_pattern_properties' => dict[
        'string' => 'some string value',
        'S_string_value' => 12,
        'I_number_value' => 'some string value',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(2);
  }

  public function testPropertiesAndPatternPropertiesInvalid(): void {
    $validator = new ObjectSchemaValidator(dict[
      'properties_and_pattern_properties' => dict[
        'string' => 12,
        'S_string_value' => 12,
        'I_number_value' => 'some string value',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(3);
  }

  public function testPropertiesAndPatternPropertiesInvalidWithValidProperties(): void {
    $validator = new ObjectSchemaValidator(dict[
      'properties_and_pattern_properties' => dict[
        'string' => 12,
        'S_string_value' => 'some string value',
        'I_number_value' => 12,
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(1);
  }

  public function testPropertiesAndPatternPropertiesNoAdditionalValid(): void {
    $validator = new ObjectSchemaValidator(dict[
      'properties_and_pattern_properties_no_additional' => dict[
        'string' => 'some string value',
        'S_string_value' => 'string value',
        'I_number_value' => 12,
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    expect($validated['properties_and_pattern_properties_no_additional'] ?? null)->toBeSame(
      shape('string' => 'some string value'),
    );
  }

  public function testPropertiesAndPatternPropertiesNoAdditionalInvalidAdditional(): void {
    $validator = new ObjectSchemaValidator(dict[
      'properties_and_pattern_properties_no_additional' => dict[
        'string' => 'some string value',
        'S_string_value' => 'string value',
        'I_number_value' => 12,
        'additional_value' => 'invalid',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(1);
  }

  public function testNestedObjectHackArrays(): void {
    $validator = new ObjectSchemaValidator(dict[
      'nested_object' => dict[
        'first' => dict[
          'second' => dict[
            'last' => 'value',
          ],
        ],
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    $this->assertMatchesInput(
      $validated['nested_object'] ?? null,
      shape(
        'first' => shape(
          'second' => shape(
            'last' => 'value',
          ),
        ),
      ),
    );
  }

  public function testNestedObjectLegacyArrays(): void {
    $validator = new ObjectSchemaValidator(
      darray['nested_object' => darray['first' => darray['second' => darray['last' => 'value']]]],
    );

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    $this->assertMatchesInput(
      $validated['nested_object'] ?? null,
      shape(
        'first' => shape(
          'second' => shape(
            'last' => 'value',
          ),
        ),
      ),
    );
  }

  public function testNestedObjectMixedHackAndLegacy(): void {
    $validator = new ObjectSchemaValidator(darray[
      'nested_object' => darray[
        'first' => dict[
          'second' => darray['last' => 'value'],
        ],
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    $this->assertMatchesInput(
      $validated['nested_object'] ?? null,
      shape(
        'first' => shape(
          'second' => shape(
            'last' => 'value',
          ),
        ),
      ),
    );
  }

  public function testCoerceObjectValidString(): void {
    $input = darray['first' => 'first', 'second' => 2];

    $validator = new ObjectSchemaValidator(darray['coerce_object' => \json_encode($input)]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue();

    $validated = $validator->getValidatedInput();
    expect($validated)->toBeSame(shape('coerce_object' => $input));
  }

  public function testCoerceObjectInvalidString(): void {
    $input = darray['first' => 2, 'second' => 'invalid'];

    $validator = new ObjectSchemaValidator(shape('coerce_object' => \json_encode($input)));
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
    expect(C\count($validator->getErrors()))->toBeSame(2);
  }

  public function testImplicitAdditionalProperties(): void {
    $input = dict[
      'implicit_additional_properties' => dict['first' => 'value', 'second' => 'value'],
    ];
    $validator = new ObjectSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    $implicit = $validated['implicit_additional_properties'] ?? null as nonnull;
    expect(
      () ==> JsonSchema\Codegen\type_assert_shape(
        $implicit,
        'Slack\Hack\JsonSchema\Tests\Generated\TObjectSchemaValidatorPropertiesImplicitAdditionalProperties',
      ),
    )->notToThrow('allows additional properties');
    $dynamic = Shapes::toDict($implicit);
    expect($dynamic['second'])->toBeSame('value', 'additional property is present');
  }

  public function testExplicitAdditionalProperties(): void {
    $input = dict[
      'explicit_additional_properties' => dict['first' => 'value', 'second' => 'value'],
    ];
    $validator = new ObjectSchemaValidator($input);
    $validator->validate();

    $validated = $validator->getValidatedInput();
    $explicit = $validated['explicit_additional_properties'] ?? null as nonnull;
    expect(
      () ==> JsonSchema\Codegen\type_assert_shape(
        $explicit,
        'Slack\Hack\JsonSchema\Tests\Generated\TObjectSchemaValidatorPropertiesExplicitAdditionalProperties',
      ),
    )->notToThrow('allows additional properties');
    $dynamic = Shapes::toDict($explicit);
    expect($dynamic['second'])->toBeSame('value', 'additional property is present');
  }

  public function testNoAdditionalProperties(): void {
    $input = dict[
      'no_additional_properties' => dict['first' => 'value', 'second' => 'value'],
    ];
    $validator = new ObjectSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();

    $no_additional = shape('first' => 'value', 'second' => 'value');
    expect(
      () ==> JsonSchema\Codegen\type_assert_shape(
        $no_additional,
        'Slack\Hack\JsonSchema\Tests\Generated\TObjectSchemaValidatorPropertiesNoAdditionalProperties',
      ),
    )->toThrow(TypeAssert\IncorrectTypeException::class);
  }

  public function testAdditionalProperitesArray(): void {
    $input = dict[
      'additional_properties_array' => dict[
        'something' => varray['array', 'of', 'strings'],
      ],
    ];

    $validator = new ObjectSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $input = dict[
      'additional_properties_array' => dict[
        'something' => varray[34, 'of', 'strings'],
      ],
    ];

    $validator = new ObjectSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();
  }

  public function testAdditionalProperitesRef(): void {
    $input = dict[
      'additional_properties_ref' => dict[
        'something' => dict[
          'something-else' => varray['array', 'of', 'strings'],
        ],
      ],
    ];

    $validator = new ObjectSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $input = dict[
      'additional_properties_ref' => dict[
        'something' => dict[
          'something-else' => varray[34, 'of', 'strings'],
        ],
      ],
    ];

    $validator = new ObjectSchemaValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();
  }

}
