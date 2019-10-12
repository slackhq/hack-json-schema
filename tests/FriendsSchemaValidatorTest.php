<?hh // partial

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\C;
use type Slack\Hack\JsonSchema\Tests\Generated\FriendsSchemaValidator;
use function Facebook\FBExpect\expect;

final class FriendsSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('friends-schema.json', 'FriendsSchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testFirstItemMissingRequiredField(): void {
    $validator = new FriendsSchemaValidator(vec[dict['age' => 25]]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should fail on missing field');

    $errors = $validator->getErrors();
    expect(C\count($errors))->toBeSame(2);

    foreach ($errors as $error) {
      expect($error['pointer'] ?? null)->toBeSame('/0');
    }
  }

  public function testSecondItemMissingRequiredField(): void {
    $validator = new FriendsSchemaValidator(vec[
      dict['first_name' => 'Bob', 'last_name' => 'Smith', 'age' => 25],
      dict['first_name' => 'Alice', 'age' => 28],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should fail on missing field');

    $errors = $validator->getErrors();
    expect(C\count($errors))->toBeSame(1);

    foreach ($errors as $error) {
      expect($error['pointer'] ?? null)->toBeSame('/1');
    }
  }

  public function testDevicesMissingRequiredField(): void {
    $validator = new FriendsSchemaValidator(vec[
      dict[
        'first_name' => 'Rezza',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['carrier' => 'Verizon']],
      ],
      dict[
        'first_name' => 'Sally',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['carrier' => 'AT&T']],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should fail on missing field');

    $errors = $validator->getErrors();
    expect(C\count($errors))->toBeSame(2);

    foreach ($errors as $index => $error) {
      expect($error['pointer'] ?? null)->toBeSame("/{$index}/~0devices~1/0");
    }
  }

  public function testDevicesNotMissingRequiredField(): void {
    $validator = new FriendsSchemaValidator(vec[
      dict[
        'first_name' => 'Rezza',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['model' => 'iPhone']],
      ],
      dict[
        'first_name' => 'Sally',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['model' => 'Samsung Galaxy']],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should be valid');
  }

  public function testArraywithAddPropsFieldFalse(): void {
    $validator = new FriendsSchemaValidator(vec[
      dict[
        'first_name' => 'Rezza',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['model' => 'iPhone']],
        'contact' => vec[5555555555, "person@example.com", "@slack-handle"],
      ],
      dict[
        'first_name' => 'Sally',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['model' => 'Samsung Galaxy']],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeTrue('should be valid');
  }

  public function testArraywithoutAddPropsFieldFalse(): void {
    $validator = new FriendsSchemaValidator(vec[
      dict[
        'first_name' => 'Rezza',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['model' => 'iPhone']],
        'rating' => vec[5555555555, "person@example.com", "@slack-handle"],
      ],
      dict[
        'first_name' => 'Sally',
        'last_name' => 'Thompson',
        '~devices/' => [['model' => 'Samsung Galaxy']],
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should be invalid');
  }

  public function testNullField(): void {
    $validator = new FriendsSchemaValidator(vec[
      dict[
        'first_name' => 'Rezza',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['model' => 'iPhone']],
        'enemies' => null,
      ],
      dict[
        'first_name' => 'Sally',
        'last_name' => 'Thompson',
        '~devices/' => vec[dict['model' => 'Samsung Galaxy']],
        'enemies' => "a bunch!",
      ],
    ]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse('should be valid');
    $errors = $validator->getErrors();
    expect(C\count($errors))->toBeSame(1);
  }
}
