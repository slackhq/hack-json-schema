<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use type Slack\Hack\JsonSchema\Codegen\Codegen;

final class CodegenForSchemaTest extends BaseCodegenTestCase {

  public function testGenerateWithSchema(): void {
    $contents =
      \file_get_contents(__DIR__.'/external_examples/friends-schema.json');

    $schema = \json_decode(
      $contents,
      true, /* default stack_depth */
      512,
      \JSON_FB_HACK_ARRAYS,
    );
    $name = "CodegenForSchemaFriendsSchema";
    $path = self::getCodeGenPath("{$name}.php");
    $root_directory = __DIR__.'/external_examples';
    $validator_config = shape(
      'namespace' => self::CODEGEN_NS,
      'file' => $path,
      'class' => $name,
      'refs' => shape(
        'root_directory' => $root_directory,
      ),
    );

    $codegen_config = shape(
      'generatedFrom' => '`make test`',
      'validator' => $validator_config,
    );

      Codegen::forSchema($schema, $codegen_config, $root_directory)->build();
  }

}
