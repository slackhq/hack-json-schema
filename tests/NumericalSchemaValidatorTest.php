<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;


use type Slack\Hack\JsonSchema\Tests\Generated\NumericalSchemaValidator;

final class NumericalSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('numerical-schema.json', 'NumericalSchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testInteger(): void {
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

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

  public function testNumber(): void {
    $cases = vec[
      shape(
        'input' => darray['number' => 1000],
        'output' => darray['number' => 1000],
        'valid' => true,
      ),
      shape(
        'input' => darray['number' => 1000.00],
        'output' => darray['number' => 1000.00],
        'valid' => true,
      ),
      shape('input' => darray['number' => '1000'], 'valid' => false),
      shape('input' => darray['number' => vec[]], 'valid' => false),
    ];

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

  public function testIntegerCoerce(): void {
    $cases = vec[
      shape(
        'input' => darray['integer_coerce' => 1],
        'output' => darray['integer_coerce' => 1],
        'valid' => true,
      ),
      shape(
        'input' => darray['integer_coerce' => '100'],
        'output' => darray['integer_coerce' => 100],
        'valid' => true,
      ),
      shape(
        'input' => darray['integer_coerce' => '100.00'],
        'valid' => false,
      ),
      shape(
        'input' => darray['integer_coerce' => 'invalid'],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

  public function testNumberCoerce(): void {
    $cases = vec[
      shape(
        'input' => darray['number_coerce' => 1.0],
        'output' => darray['number_coerce' => 1.0],
        'valid' => true,
      ),
      shape(
        'input' => darray['number_coerce' => '100'],
        'output' => darray['number_coerce' => 100],
        'valid' => true,
      ),
      shape(
        'input' => darray['number_coerce' => '100.0'],
        'output' => darray['number_coerce' => 100.0],
        'valid' => true,
      ),
      shape(
        'input' => darray['number_coerce' => 'invalid'],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

}
