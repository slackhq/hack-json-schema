<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

class StringFormatConstraint {
  public static function check(
    string $input,
    string $format,
    string $pointer,
  ): void {

    switch ($format) {
      case 'date':
        $dt = \DateTime::createFromFormat('Y-m-d', $input);

        if (!$dt) {
          $error = shape(
            'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
            'constraint' => shape(
              'type' => JsonSchema\FieldErrorConstraint::FORMAT,
              'expected' => $format,
              'got' => $input,
            ),
            'message' => "input must be a valid: {$format}",
          );
          throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
        }
        break;
      default:
        break;
    }
  }
}
