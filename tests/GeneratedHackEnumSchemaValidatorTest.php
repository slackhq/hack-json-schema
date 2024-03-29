<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;


use type Slack\Hack\JsonSchema\Tests\Generated\GeneratedHackEnumSchemaValidator;

final class GeneratedHackEnumSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('generated-hack-enum-schema.json', 'GeneratedHackEnumSchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }
  public function testStringEnum(): void {
    $cases = vec[
      shape(
        'input' => dict['enum_string' => 'one'],
        'output' => dict['enum_string' => 'one'],
        'valid' => true,
      ),
      shape(
        'input' => dict['enum_string' => 'four'],
        'valid' => false,
      ),
      shape(
        'input' => dict['enum_string' => 1],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new GeneratedHackEnumSchemaValidator($input));
  }
}
