<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;


use type Slack\Hack\JsonSchema\Tests\Generated\DefaultsSchemaValidator;

final class DefaultsSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder(
      'defaults-schema.json',
      'DefaultsSchemaValidator',
      shape('defaults' => shape('coerce' => true)),
    );
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testBoolean(): void {
    $cases = vec[
      shape(
        'input' => ['boolean' => true],
        'output' => ['boolean' => true],
        'valid' => true,
      ),
      shape(
        'input' => ['boolean' => 0],
        'output' => ['boolean' => false],
        'valid' => true,
      ),
      shape(
        'input' => ['boolean' => 'false'],
        'output' => ['boolean' => false],
        'valid' => true,
      ),
      shape(
        'input' => ['boolean' => 'true'],
        'output' => ['boolean' => true],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new DefaultsSchemaValidator($input));
  }

  public function testBooleanCoerceFalse(): void {
    $cases = vec[
      shape(
        'input' => ['boolean_coerce_false' => true],
        'output' => ['boolean_coerce_false' => true],
        'valid' => true,
      ),
      shape(
        'input' => ['boolean_coerce_false' => 0],
        'valid' => false,
      ),
      shape(
        'input' => ['boolean_coerce_false' => 'false'],
        'valid' => false,
      ),
      shape(
        'input' => ['boolean_coerce_false' => 'true'],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new DefaultsSchemaValidator($input));
  }

  public function testNestedCoerceFalse(): void {
    $cases = vec[
      shape(
        'input' => [
          'nested_coerce_false' =>
            ['boolean_prop' => 'false', 'number_prop' => 3],
        ],
        'output' => [
          'nested_coerce_false' =>
            ['boolean_prop' => false, 'number_prop' => 3],
        ],
        'valid' => true,
      ),
      shape(
        'input' => [
          'nested_coerce_false' =>
            ['boolean_prop' => true, 'number_prop' => '3'],
        ],
        'valid' => false,
      ),
    ];
  }

}
