namespace Slack\Hack\JsonSchema\Tests;

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

  public function testTopLevelRef(): void {
    $cases = vec[
      shape(
        'input' => darray['integer' => 1000],
        'output' => darray['integer' => 1000],
        'valid' => true,
      ),
      shape(
        'input' => darray['integer' => 0],
        'output' => darray['integer' => 0],
        'valid' => true,
      ),
      shape('input' => darray['integer' => '1000'], 'valid' => false),
      shape('input' => darray['integer' => 1000.00], 'valid' => false),
    ];

    $this->expectCases($cases, $input ==> new TopLevelRefValidator($input));
  }
}
