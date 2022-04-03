<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<f0d4600667c097dc2374711aba82c6f2>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;

type TAnyOfValidator3 = null;

final class AnyOfValidator3 extends JsonSchema\BaseValidator<TAnyOfValidator3> {

  public static function check(
    mixed $input,
    string $pointer,
  ): TAnyOfValidator3 {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
    ];
    $errors = vec[
    ];

    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($input, $pointer);
        return $output;
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $error = shape(
      'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
      'constraint' => shape(
        'type' => JsonSchema\FieldErrorConstraint::ANY_OF,
      ),
      'message' => 'failed to match any allowed schemas',
    );

    $output_errors = vec[$error];
    $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
    throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
  }

  <<__Override>>
  protected function process(): TAnyOfValidator3 {
    return self::check($this->input, $this->pointer);
  }
}
