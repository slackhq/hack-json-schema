<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\Str;

use type Slack\Hack\JsonSchema\Tests\Generated\StringSchemaValidator;

enum TestStringEnum: string {
  ABC = 'foo';
  DEF = 'bar';
}

function _string_schema_validator_test_uniline(string $input): string {
  return $input
    |> Str\replace($$, ' ', '_')
    |> Str\replace($$, "\n", ' ');
}

function _string_schema_validator_test_multiline(string $input): string {
  return $input
    |> Str\replace($$, ' ', '_');
}

final class StringSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder(
      'string-schema.json',
      'StringSchemaValidator',
      shape(
        'sanitize_string' => shape(
          'uniline' => _string_schema_validator_test_uniline<>,
          'multiline' => _string_schema_validator_test_multiline<>,
        ),
      ),
    );
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testSimple(): void {
    $cases = vec[
      shape(
        'input' => darray['simple' => 'valid'],
        'output' => darray['simple' => 'valid'],
        'valid' => true,
      ),
      shape(
        'input' => darray['simple' => 0],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testCoerce(): void {
    $cases = vec[
      shape(
        'input' => darray['coerce' => 'valid'],
        'output' => darray['coerce' => 'valid'],
        'valid' => true,
      ),
      shape(
        'input' => darray['coerce' => 0],
        'output' => darray['coerce' => '0'],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testSanitizeUnilineString(): void {
    $cases = vec[
      shape(
        'input' => darray['sanitize_uniline' => 'some string'],
        'output' => darray['sanitize_uniline' => 'some_string'],
        'valid' => true,
      ),
      shape(
        'input' => darray['sanitize_uniline' => "some string\nhere there"],
        'output' => darray['sanitize_uniline' => 'some_string here_there'],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testSanitizeMultilineString(): void {
    $cases = vec[
      shape(
        'input' => darray['sanitize_multiline' => "some string\nhere there"],
        'output' => darray['sanitize_multiline' => "some_string\nhere_there"],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testFormatDateString(): void {
    $cases = vec[
      shape(
        'input' => darray['date_format' => '2000-01-01'],
        'output' => darray['date_format' => '2000-01-01'],
        'valid' => true,
      ),
      shape(
        'input' => darray['date_format' => '2000-01-100'],
        'valid' => false,
      ),
      shape(
        'input' => darray['date_format' => 'invalid_date'],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testHackEnum(): void {
    $cases = vec[
      shape(
        'input' => darray['hack_enum' => 'foo'],
        'output' => darray['hack_enum' => TestStringEnum::ABC],
        'valid' => true,
      ),
      shape(
        'input' => darray['hack_enum' => 'bar'],
        'output' => darray['hack_enum' => TestStringEnum::DEF],
        'valid' => true,
      ),
      shape('input' => darray['hack_enum' => 'ABC'], 'valid' => false),
      shape('input' => darray['hack_enum' => 'aaaaaaaaaaaaa'], 'valid' => false),
      shape('input' => darray['hack_enum' => ''], 'valid' => false),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

}
