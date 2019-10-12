<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\C;
use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\{AddressSchemaFileValidator, AddressSchemaValidator};

final class AddressSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('address-schema.json', 'AddressSchemaValidator');
    $ret['codegen']->build();
    $ret_remote = self::getBuilder('address-schema-remote.json', 'AddressSchemaFileValidator');
    $ret_remote['codegen']->build();
    require_once($ret['path']);
    require_once($ret_remote['path']);
  }

  public function testInvalidEmptyInput(): void {
    $validator = new AddressSchemaValidator(dict[]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('empty input results in an error');
  }

  public function testValidAddress(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'postal-code' => '94012',
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeTrue('valid input is valid');
  }

  public function testNonStringInputs(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => ['invalid'],
      'country-name' => 7,
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeFalse('non string inputs are invalid');
    expect(\count($validator->getErrors()))->toBeSame(2);
  }

  public function testAddressWithNumericPostalCode(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'postal-code' => 94102,
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('numeric postal codes should be valid');
  }

  public function testAddressWithInvalidPostalCode(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'postal-code' => 94102.02,
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('postal code must be an integer');
  }

  public function testAddressWithFileRef(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'postal-code' => 94102,
      'phones' => vec[
        dict['model' => 'iPhone 6', 'carrier' => 'Verizon'],
        dict['model' => 'Samsung Galaxy', 'carrier' => 'Cricket'],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('file reference to phone type should be valid');
  }

  public function testAddressWithSizeAllOf(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'size' => 200,
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeTrue('should be valid as 200 is both an integer and a number');
  }

  public function testAddressWithSizeAllOfFailure(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'size' => 200.5,
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeFalse('should not be valid as 200.5 is not an integer');
  }

  public function testAddressWithLongitudeNot(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'longitude' => 200.5,
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeTrue('should be valid as 200.5 is not an integer nor a string');
  }

  public function testAddressWithLongitudeNotFailure(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'longitude' => 200,
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeFalse('should not be valid as 200 is an integer');
  }

  public function testAddressWithLatitudeOneOf(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'latitude' => 200.5,
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeTrue('should be valid as 200.5 is not an integer but is a number');
  }

  public function testAddressWithLatitudeOneOfFailure(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'latitude' => 200,
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeFalse('should not be valid as 200 is an integer and number');
  }

  public function testAddressWithFailedFileRef(): void {
    $validator = new AddressSchemaValidator(dict[
      'locality' => 'San Francisco',
      'region' => vec['California'],
      'country-name' => 'United States',
      'postal-code' => 94102,
      'phones' => vec[
        dict['model' => 6, 'carrier' => 'Verizon'],
        dict['model' => 7, 'carrier' => 'Cricket'],
      ],
    ]);
    $validator->validate();
    expect($validator->isValid())->toBeFalse('file reference to phone type should be invalid');
    expect(\count($validator->getErrors()))->toBeSame(3);
  }

  public function testAddressWithDifferentFileRef(): void {
    $validator = new AddressSchemaFileValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'postal-code' => 94102,
      'age' => 20,
      'nickname' => 'home',
      'phones' => vec[
        dict['model' => 6, 'carrier' => 'Verizon'],
        dict['model' => 7, 'carrier' => 'Cricket'],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('file reference to phone type should be valid');
  }

  public function testAddressWithFalseDepthRefs(): void {
    $validator = new AddressSchemaFileValidator(dict[
      'locality' => 'San Francisco',
      'region' => 'California',
      'country-name' => 'United States',
      'postal-code' => 94102,
      'age' => -29,
      'nickname' => 0,
      'phones' => vec[
        dict['model' => 6, 'carrier' => 'Verizon'],
        dict['model' => 7, 'carrier' => 'Cricket'],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('file reference to phone type should be valid');
    expect(C\count($validator->getErrors()))->toBeSame(2);
  }

}
