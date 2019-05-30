<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

interface IJsonSchemaCodegenConfig {
  public function getTypeNamePrefix(): string;
  public function getTypeNameSuffix(): string;
  public function getClassNameFormatFunction(): (function(string...): string);
  public function getTypeNameFormatFunction(): (function(string...): string);
  public function getFileNameFormatFunction(): (function(string...): string);
}
