<?hh

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\NumericalSchemaValidator;

final class NumericalSchemaValidatorTest extends BaseCodegenTestCase {

  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret =
      self::getBuilder('numerical-schema.json', 'NumericalSchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testInteger(): void {
    $cases = vec[
      shape(
        'input' => ['integer' => 1000],
        'output' => ['integer' => 1000],
        'valid' => true,
      ),
      shape(
        'input' => ['integer' => 0],
        'output' => ['integer' => 0],
        'valid' => true,
      ),
      shape('input' => ['integer' => '1000'], 'valid' => false),
      shape('input' => ['integer' => 1000.00], 'valid' => false),
    ];

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

  public function testNumber(): void {
    $cases = vec[
      shape(
        'input' => ['number' => 1000],
        'output' => ['number' => 1000],
        'valid' => true,
      ),
      shape(
        'input' => ['number' => 1000.00],
        'output' => ['number' => 1000.00],
        'valid' => true,
      ),
      shape('input' => ['number' => '1000'], 'valid' => false),
      shape('input' => ['number' => vec[]], 'valid' => false),
    ];

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

  public function testIntegerCoerce(): void {
    $cases = vec[
      shape(
        'input' => ['integer_coerce' => 1],
        'output' => ['integer_coerce' => 1],
        'valid' => true,
      ),
      shape(
        'input' => ['integer_coerce' => '100'],
        'output' => ['integer_coerce' => 100],
        'valid' => true,
      ),
      shape(
        'input' => ['integer_coerce' => '100.00'],
        'valid' => false,
      ),
      shape(
        'input' => ['integer_coerce' => 'invalid'],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

  public function testNumberCoerce(): void {
    $cases = vec[
      shape(
        'input' => ['number_coerce' => 1.0],
        'output' => ['number_coerce' => 1.0],
        'valid' => true,
      ),
      shape(
        'input' => ['number_coerce' => '100'],
        'output' => ['number_coerce' => 100],
        'valid' => true,
      ),
      shape(
        'input' => ['number_coerce' => '100.0'],
        'output' => ['number_coerce' => 100.0],
        'valid' => true,
      ),
      shape(
        'input' => ['number_coerce' => 'invalid'],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new NumericalSchemaValidator($input));
  }

}
