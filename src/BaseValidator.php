<?hh // strict

namespace Slack\Hack\JsonSchema;

use namespace HH\Lib\C;

<<__ConsistentConstruct>>
abstract class BaseValidator<+T> implements Validator<T> {
  private vec<TFieldError> $errors = vec[];
  <<__LateInit>> private T $validated_input;
  private bool $has_been_validated = false;
  <<__LateInit>> private bool $is_invalid;

  public function __construct(protected mixed $input, protected string $pointer = '') {}

  abstract protected function process(): T;

  final public function validate(): void {
    try {
      $this->validated_input = $this->process();
      $this->is_invalid = false;
    } catch (InvalidFieldException $e) {
      $this->errors = $e->errors;
      $this->is_invalid = true;
    }
    $this->has_been_validated = true;
  }

  final public function isValid(): bool {
    return !C\count($this->errors);
  }

  final public function getErrors(): vec<TFieldError> {
    return $this->errors;
  }

  final public function getValidatedInput(): T {
    if (!$this->has_been_validated) {
      throw new \Exception('Must call `validate` before accessing validated input.');
    }
    if ($this->is_invalid) {
      throw new \Exception("Can't access validated input since validator is invalid.");
    }

    return $this->validated_input;
  }

}

interface Validator<+T> {
  public function validate(): void;
  public function isValid(): bool;
  public function getErrors(): vec<TFieldError>;
  public function getValidatedInput(): ?T;
}
