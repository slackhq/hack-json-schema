
namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\TopLevelRefValidator;

final class TopLevelRefValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder(
      'top-level-ref.json',
      'TopLevelRefValidator',
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

  public function testValidatorDelegates(): void {
    $validator = new TopLevelRefValidator('foo');
    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $validator = new TopLevelRefValidator(3);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();
  }
}
