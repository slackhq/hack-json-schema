<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

trait Factory {
  protected Context $ctx;

  protected function generateClassName(string ...$parts): string {
    $config = $this->ctx->getJsonSchemaCodegenConfig();
    return $config->getClassNameFormatFunction()(...$parts);
  }

  protected function generateTypeName(string $input): string {
    $config = $this->ctx->getJsonSchemaCodegenConfig();
    $processed = $config->getTypeNameFormatFunction()($input);
    return \HH\Lib\Str\format(
      '%s%s%s',
      $config->getTypeNamePrefix(),
      $processed,
      $config->getTypeNameSuffix(),
    );
  }
}
