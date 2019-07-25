<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use type Slack\Hack\JsonSchema\Codegen\Codegen;
use type Slack\Hack\JsonSchema\Tests\Generated\{ExamplesStringSchema, ExternalExamplesFriendsSchema};

final class CodegenForPathsTest extends BaseCodegenTestCase {

  public function testGenerateWithPaths(): void {
    $paths = vec[
      __DIR__.'/external_examples/friends-schema.json',
      __DIR__.'/external_examples/ref-schema.json',
      __DIR__.'/examples/string-schema.json',
    ];

    $config = shape(
      'validator' => shape(
        'namespace' => self::CODEGEN_NS,
        'refs' => shape(
          'unique' => shape(
            'source_root' => __DIR__,
            'output_root' => __DIR__.'/examples/codegen',
          ),
        ),
        'sanitize_string' => shape(
          'uniline' => fun('\Slack\Hack\JsonSchema\Tests\_string_schema_validator_test_uniline'),
          'multiline' => fun('\Slack\Hack\JsonSchema\Tests\_string_schema_validator_test_multiline'),
        ),
      ),
      'generatedFrom' => '`make test`',
    );

    $codegens = Codegen::forPaths($paths, $config);
    foreach ($codegens as $codegen) {
      $codegen->build();
    }

    $validators = vec[
      new ExamplesStringSchema(dict[]),
      new ExternalExamplesFriendsSchema(dict[]),
    ];
    foreach ($validators as $validator) {
      $validator->validate();
    }
  }

}
