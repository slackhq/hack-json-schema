<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\C;
use function Facebook\FBExpect\expect;
use type Slack\Hack\JsonSchema\Tests\Generated\PersonSchemaValidator;

final class PersonSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('person-schema.json', 'PersonSchemaValidator');
    $res = $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testInvalidEmptyInput(): void {
    $validator = new PersonSchemaValidator(dict[]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse(
      'should have failed on empty input',
    );
  }

  public function testValidSchema(): void {
    $input =
      dict['first_name' => 'Michael', 'last_name' => 'Hahn', 'age' => 29];

    $validator = new PersonSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should have been valid input');
    $validated = $validator->getValidatedInput();

    $this->assertMatchesInput(
      $input,
      /* HH_FIXME[4110] invalid arg */
      Shapes::toDict($validated),
      'should have validated input',
    );
  }

  public function testInvalidPartialAge(): void {
    $validator = new PersonSchemaValidator(
      dict['first_name' => 'Michael', 'last_name' => 'Hahn', 'age' => 29.8],
    );
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should fail from partial age');
  }

  public function testNegativeAge(): void {
    $validator = new PersonSchemaValidator(
      dict['first_name' => 'Michael', 'last_name' => 'Hahn', 'age' => -29],
    );
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should fail from negative age');
  }

  public function testValidFriends(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'friends' => vec[
        dict['first_name' => 'Kermit', 'last_name' => 'the Frog'],
        dict['first_name' => 'Elmo', 'last_name' => 'Red Guy', 'age' => 100],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should have valid friends array');
  }

  public function testInvalidFriendsAge(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'friends' => vec[
        dict['first_name' => 'Kermit', 'last_name' => 'the Frog'],
        dict['first_name' => 'Elmo', 'last_name' => 'Red Guy', 'age' => -100],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse(
      'should have failed with invalid friends age',
    );
  }

  public function testInvalidStringAndNumber(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'string_and_number' => vec['all', 'strings'],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse(
      'should require one string and one number',
    );
  }

  public function testValidStringAndNumber(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'string_and_number' => vec['all', 100],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should have been valid input');
  }

  public function testValidDevices(): void {
    $input = dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'devices' => vec[
        dict['type' => 'phone', 'model' => 'iphone', 'carrier' => 'AT&T'],
        dict['type' => 'computer', 'manufacturer' => 'apple', 'year' => 2017],
      ],
    ];

    $validator = new PersonSchemaValidator($input);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should be valid');
    $validated = $validator->getValidatedInput();

    $this->assertMatchesInput(
      $input,
      /* HH_FIXME[4110] invalid arg */
      Shapes::toDict($validated),
      'should have validated input',
    );
  }

  public function testInvalidDevices(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'devices' => vec[
        dict['type' => 'phone', 'carrier' => 'AT&T'],
        dict['type' => 'unknown', 'year' => 2017],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should be invalid');
  }

  public function testFriendsAdditionalProperties(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'friends' => vec[dict[
        'first_name' => 'Sally',
        'last_name' => 'Woo',
        'invalid_extra' => true,
      ]],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should be invalid');
  }

  public function testDevicesComputerAdditionalProperties(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'devices' => vec[
        dict['type' => 'computer', 'manufacturer' => 'Apple', 'extra' => true],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue(
      'should allow additional properties',
    );

    $validated = $validator->getValidatedInput();
    $devices = $validated['devices'] ?? null as nonnull;

    $device = $devices[0];
    invariant(is_array($device), 'device should be array');

    $extra = $device['extra'] ?? null;
    expect($extra)->toBeSame(
      true,
      'additional properties should  be included in output',
    );
  }

  public function testDevicesPhoneValidAdditionalProperties(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'devices' => vec[
        dict[
          'type' => 'phone',
          'model' => 'iPhone',
          'carrier' => 'AT&T',
          'number' => '(888)555-1212',
          'extra' => 'valid',
        ],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue(
      'should allow additional properties that are strings',
    );

    $validated = $validator->getValidatedInput();
    $devices = $validated['devices'] ?? null as nonnull;

    $device = $devices[0];
    invariant(is_array($device), 'device should be array');

    $extra = $device['extra'] ?? null;
    expect($extra)->toBeSame(
      null,
      "additional properties aren't set if other properties are defined",
    );
  }

  public function testDevicesPhoneInvalidAdditionalProperties(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => vec['Hahn'],
      'devices' => vec[
        dict[
          'type' => 'phone',
          'model' => 'iPhone',
          'carrier' => 'AT&T',
          'extra' => true,
        ],
      ],
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeFalse(
      "should not allow additional properties that aren't strings",
    );
    expect(C\count($validator->getErrors()))->toBeSame(2);
  }

  public function testInvalidPhoneNumber(): void {
    $validator = new PersonSchemaValidator(dict[
      'first_name' => 'Michael',
      'last_name' => 'Hahn',
      'devices' => vec[
        dict[
          'type' => 'phone',
          'model' => 'iPhone',
          'carrier' => 'AT&T',
          'number' => '(888)FLOWERS',
          'extra' => 'valid',
        ],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse(
      'should be invalid phone number pattern',
    );
  }

  public function testValidStringOrNumber(): void {
    $validator = new PersonSchemaValidator(
      dict[
        'first_name' => 'Michael',
        'last_name' => 'Hahn',
        'string_or_num' => 1,
      ],
    );
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should accept integer');

    $validator = new PersonSchemaValidator(
      dict[
        'first_name' => 'Michael',
        'last_name' => 'Hahn',
        'string_or_num' => 'string',
      ],
    );
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should accept string');
  }

  public function testInvalidStringOrNumber(): void {
    $validator = new PersonSchemaValidator(
      dict[
        'first_name' => 'Michael',
        'last_name' => 'Hahn',
        'string_or_num' => vec['test'],
      ],
    );
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should reject boolean');
  }

}
