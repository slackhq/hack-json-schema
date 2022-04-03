<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\{C, Math, Str};
use function Facebook\FBExpect\expect;
use type Slack\Hack\JsonSchema\Validator;
use type Slack\Hack\JsonSchema\Codegen\{Codegen, IJsonSchemaCodegenConfig, TSchema};
use type Facebook\HackTest\HackTest;

abstract class BaseCodegenTestCase extends HackTest {

  const string CODEGEN_ROOT = __DIR__.'/examples/codegen';
  const string CODEGEN_NS = 'Slack\\Hack\\JsonSchema\\Tests\\Generated';

  const type TOptions = shape(
    ?'sanitize_string' => Codegen::TSanitizeStringConfig,
    ?'json_schema_codegen_config' => IJsonSchemaCodegenConfig,
    ?'refs' => Codegen::TValidatorRefsConfig,
    ?'defaults' => Codegen::TValidatorDefaultsConfig,
    ?'discard_additional_properties' => bool,
  );

  public function assertUnchanged(string $_value, ?string $_token = null): void {
    self::markTestSkipped("assertUnchanged doesn't work in hacktest yet");

    /*

    /\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\
    | This code never runs, because of the markTestSkipped above.    |
    | HHVM 4.3+ can't find \Facebook\HackCodegen\CodegenExpectedFile.|
    \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/

    $class_name = static::class;
    $path = \Facebook\HackCodegen\CodegenExpectedFile::getPath($class_name);
    $expected = \Facebook\HackCodegen\CodegenExpectedFile::parseFile($path);
    $token = $token === null
      ? \Facebook\HackCodegen\CodegenExpectedFile::findToken()
      : $token;

    if ($expected->contains($token) && $expected[$token] === $value) {
      return;
    }

    $new_expected = clone $expected;
    $new_expected[$token] = $value;
    \Facebook\HackCodegen\CodegenExpectedFile::writeExpectedFile(
      $path,
      $new_expected,
      $expected,
    );

    $expected = \Facebook\HackCodegen\CodegenExpectedFile::parseFile($path);
    invariant(
      $expected->contains($token) && $expected[$token] === $value,
      'New value not accepted by user',
    );
    */
  }

  public static function getCodeGenRoot(): string {
    return self::CODEGEN_ROOT;
  }

  public static function getCodeGenPath(string $file): string {
    return self::getCodeGenRoot()."/{$file}";
  }

  public static function getBuilder(string $json_filename, string $name, this::TOptions $options = shape()): shape(
    'path' => string,
    'codegen' => Codegen,
  ) {
    $codegen_config = self::getConfig($name, $options);
    $codegen = Codegen::forPath(__DIR__."/examples/{$json_filename}", $codegen_config);

    return shape(
      'path' => $codegen_config['validator']['file'],
      'codegen' => $codegen,
    );
  }

  public static function getBuilderForSchema(TSchema $schema, string $name, this::TOptions $options = shape()): shape(
    'path' => string,
    'codegen' => Codegen,
  ) {
    $codegen_config = self::getConfig($name, $options);
    $codegen = Codegen::forSchema(Shapes::toDict($schema), $codegen_config, __DIR__.'/examples/');

    return shape(
      'path' => $codegen_config['validator']['file'],
      'codegen' => $codegen,
    );
  }

  private static function getConfig(string $name, this::TOptions $options): Codegen::TCodegenConfig {
    $path = self::getCodeGenPath("{$name}.php");
    $validator_config = shape(
      'namespace' => self::CODEGEN_NS,
      'file' => $path,
      'class' => $name,
    );

    if (Shapes::keyExists($options, 'discard_additional_properties')) {
      $validator_config['discard_additional_properties'] = $options['discard_additional_properties'];
    }

    $defaults = $options['defaults'] ?? null;
    if ($defaults is nonnull) {
      $validator_config['defaults'] = $defaults;
    }

    $sanitize_string = $options['sanitize_string'] ?? null;
    if ($sanitize_string is nonnull) {
      $validator_config['sanitize_string'] = $sanitize_string;
    }

    $refs = $options['refs'] ?? null;
    if ($refs is nonnull) {
      $validator_config['refs'] = $refs;
    }

    $codegen_config = shape(
      'generatedFrom' => '`make test`',
      'validator' => $validator_config,
      'discardChanges' => true
    );

    $json_schema_codegen_config = $options['json_schema_codegen_config'] ?? null;
    if ($json_schema_codegen_config is nonnull) {
      $codegen_config['jsonSchemaCodegenConfig'] = $json_schema_codegen_config;
    }

    return $codegen_config;
  }

  public static function benchmark(string $label, (function(): void) $callback): void {
    $benchmarks = vec[];

    for ($i = 0; $i < 1000; $i++) {
      $start = self::microtimeMs();
      $callback();
      $end = self::microtimeMs();
      $benchmarks[] = $end - $start;
    }

    $average = Math\sum($benchmarks) / C\count($benchmarks);
    echo Str\format("%s took: %s\n", $label, (string)$average);
  }

  public static function microtimeMs(): int {
    $gtod = \gettimeofday();
    return ($gtod['sec'] * 1000) + ((int)($gtod['usec'] / 1000));
  }

  public function assertMatchesInput(mixed $expected, mixed $got, string $msg = ''): void {
    if (!($expected is KeyedContainer<_, _>) || !($got is KeyedContainer<_, _>)) {
      expect($expected)->toBeSame($got, $msg);
      return;
    }

    foreach ($expected as $key => $expected_value) {
      /*HH_IGNORE_ERROR[4110] HHVM4.0.4 does not want you to use $key in the subscript here*/
      $got_value = $got[$key] ?? null;

      if ($expected is KeyedContainer<_, _> && $got_value is KeyedContainer<_, _>) {
        $this->assertMatchesInput($expected_value, $got_value, $msg);
        return;
      }

      expect($expected_value)->toBeSame($got_value, Str\format('%s: mismatch on %s', $msg, (string)$key));
    }
  }

  public function expectCases<T>(
    vec<shape('input' => mixed, ?'output' => mixed, 'valid' => bool)> $cases,
    (function(mixed): Validator<T>) $init,
  ): void {

    foreach ($cases as $case) {
      $validator = $init($case['input']);
      $validator->validate();

      $input = \print_r($case['input'], true);
      if ($case['valid']) {
        expect($validator->isValid())->toBeTrue("should be valid for input: {$input}");
      } else {
        expect($validator->isValid())->toBeFalse("should be invalid for input: {$input}");
      }

      $output = $case['output'] ?? null;
      if ($output is nonnull) {
        expect($validator->getValidatedInput())->toBeSame($output);
      }
    }
  }

}
