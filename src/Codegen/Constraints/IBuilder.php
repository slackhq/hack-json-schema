<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

interface IBuilder {
  public function getClassName(): string;
  public function getType(): string;
  public function isArrayKeyType(): bool;
  public function build(): this;
  public function setSuffix(string $suffix): void;
  public function getTypeInfo(): Typing\Type;
}
