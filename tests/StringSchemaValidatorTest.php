<?hh // partial

namespace Slack\Hack\JsonSchema\Tests;


use type Slack\Hack\JsonSchema\Tests\Generated\StringSchemaValidator;

function _string_schema_validator_test_uniline(string $input): string {
  return $input
    |> \str_replace(' ', '_', $$)
    |> \str_replace("\n", ' ', $$);
}

function _string_schema_validator_test_multiline(string $input): string {
  return $input
    |> \str_replace(' ', '_', $$);
}

final class StringSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder(
      'string-schema.json',
      'StringSchemaValidator',
      shape(
        'sanitize_string' => shape(
          'uniline' => fun(
            '\Slack\Hack\JsonSchema\Tests\_string_schema_validator_test_uniline',
          ),
          'multiline' => fun(
            '\Slack\Hack\JsonSchema\Tests\_string_schema_validator_test_multiline',
          ),
        ),
      ),
    );
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testSimple(): void {
    $cases = vec[
      shape(
        'input' => ['simple' => 'valid'],
        'output' => ['simple' => 'valid'],
        'valid' => true,
      ),
      shape(
        'input' => ['simple' => 0],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testCoerce(): void {
    $cases = vec[
      shape(
        'input' => ['coerce' => 'valid'],
        'output' => ['coerce' => 'valid'],
        'valid' => true,
      ),
      shape(
        'input' => ['coerce' => 0],
        'output' => ['coerce' => '0'],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testSanitizeUnilineString(): void {
    $cases = vec[
      shape(
        'input' => ['sanitize_uniline' => 'some string'],
        'output' => ['sanitize_uniline' => 'some_string'],
        'valid' => true,
      ),
      shape(
        'input' => ['sanitize_uniline' => "some string\nhere there"],
        'output' => ['sanitize_uniline' => 'some_string here_there'],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testSanitizeMultilineString(): void {
    $cases = vec[
      shape(
        'input' => ['sanitize_multiline' => "some string\nhere there"],
        'output' => ['sanitize_multiline' => "some_string\nhere_there"],
        'valid' => true,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

  public function testFormatDateString(): void {
    $cases = vec[
      shape(
        'input' => ['date_format' => "2000-01-01"],
        'output' => ['date_format' => "2000-01-01"],
        'valid' => true,
      ),
      shape(
        'input' => ['date_format' => "2000-01-100"],
        'valid' => false,
      ),
      shape(
        'input' => ['date_format' => "invalid_date"],
        'valid' => false,
      ),
    ];

    $this->expectCases($cases, $input ==> new StringSchemaValidator($input));
  }

}
