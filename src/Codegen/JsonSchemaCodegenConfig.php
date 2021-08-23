<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

final class JsonSchemaCodegenConfig implements IJsonSchemaCodegenConfig {
  public function getTypeNamePrefix(): string {
    return 'T';
  }

  public function getTypeNameSuffix(): string {
    return '';
  }

  public function getClassNameFormatFunction(): (function(string...): string) {
    return format<>;
  }

  public function getTypeNameFormatFunction(): (function(string...): string) {
    return format<>;
  }

  public function getFileNameFormatFunction(): (function(string...): string) {
    return format<>;
  }
}
