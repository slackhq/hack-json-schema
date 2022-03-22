<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

interface IBuilder {
  public function build(): this;
  public function getClassName(): string;
  public function getType(): string;
  public function isArrayKeyType(): bool;
  public function setSuffix(string $suffix): void;
}
