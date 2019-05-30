<?hh // strict

namespace Slack\Hack\JsonSchema;

enum FieldErrorCode: string {
  MISSING_FIELD = 'missing_field';
  INVALID_TYPE = 'invalid_type';
  FAILED_CONSTRAINT = 'failed_constraint';
}

enum FieldErrorConstraint: string {
  MIN_ITEMS = 'min_items';
  MAX_ITEMS = 'max_items';
  MAX_LENGTH = 'max_length';
  MIN_LENGTH = 'min_length';
  MAXIMUM = 'maximum';
  MINIMUM = 'minimum';
  ENUM = 'enum';
  PATTERN = 'pattern';
  FORMAT = 'format';
  ADDITIONAL_PROPERTIES = 'additional_properties';
  ANY_OF = 'any_of';
  ALL_OF = 'all_of';
  NOT = 'not';
  ONE_OF = 'one_of';
}

type TFieldError = shape(
  'code' => FieldErrorCode,
  'message' => string,
  ?'pointer' => string,
  ?'constraint' => shape(
    'type' => FieldErrorConstraint,
    ?'expected' => mixed,
    ?'got' => mixed,
  ),
  ?'field' => string,
);

class CircularReferenceException extends \Exception {}

class InvalidFieldException extends \Exception {
  public vec<TFieldError> $errors;

  public function __construct(
    public string $pointer,
    vec<TFieldError> $errors,
    int $code = 0,
    ?\Exception $previous = null,
  ) {

    // NB: If we haven't set `pointer` for the errors, set it now. If it is already
    // set it means we're bubbling the errors up and don't want to override the
    // more specific pointer for nested items.
    $errors = \HH\Lib\Vec\map(
      $errors,
      $error ==> {
        $error_pointer = $error['pointer'] ?? null;
        if ($error_pointer === null) {
          $error['pointer'] = $pointer;
        }
        return $error;
      },
    );
    $this->errors = $errors;

    $formatted_errors = \HH\Lib\Vec\map($errors, $error ==> $error['message'])
      |> \HH\Lib\Str\join($$, '');
    $message = "Error validating field '{$pointer}': {$formatted_errors}";
    parent::__construct($message, $code, $previous);
  }
}
