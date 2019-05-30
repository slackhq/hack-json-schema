<?hh

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;
use type Slack\Hack\JsonSchema\Tests\Generated\GeoSchemaValidator;

final class GeoSchemaValidatorTest extends BaseCodegenTestCase {

  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('geo-schema.json', 'GeoSchemaValidator');
    $ret['codegen']->build();
    /* HH_IGNORE_ERROR[1002] intentionally using require_once outside of top-level */
    require_once($ret['path']);
  }

  public function testValidateValidInput(): void {
    $validator = new GeoSchemaValidator(
      dict['latitude' => 37.7749, 'longitude' => 122.4194],
    );
    $validator->validate();

    expect($validator->isValid())->toBeTrue();
  }

  public function testValidateMissingFields(): void {
    $validator = new GeoSchemaValidator(dict[]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testValidateLatitudeOverMaximum(): void {
    $validator =
      new GeoSchemaValidator(dict['latitude' => 180, 'longitude' => 120]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

  public function testValidateLongitudeOverMaximum(): void {
    $validator =
      new GeoSchemaValidator(dict['latitude' => 37, 'longitude' => 190]);
    $validator->validate();

    expect($validator->isValid())->toBeFalse();
  }

}
