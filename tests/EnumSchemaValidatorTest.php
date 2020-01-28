<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;


use type Slack\Hack\JsonSchema\Tests\Generated\EnumSchemaValidator;

final class EnumSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('enum-schema.json', 'EnumSchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testStringEnum(): void {
    $cases = vec[
      shape(
        'input' => darray['enum_string' => "one"],
        'output' => darray['enum_string' => "one"],
        'valid' => true,
      ),
      shape(
        'input' => darray['enum_string' => "four"],
        'valid' => false,
      ),
      shape(
        'input' => darray['enum_string' => 1],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new EnumSchemaValidator($input));
  }

  public function testNumberEnum(): void {
    $cases = vec[
      shape(
        'input' => darray['enum_number' => 1],
        'output' => darray['enum_number' => 1],
        'valid' => true,
      ),
      shape(
        'input' => darray['enum_number' => "four"],
        'valid' => false,
      ),
      shape(
        'input' => darray['enum_number' => 4],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new EnumSchemaValidator($input));
  }

}
