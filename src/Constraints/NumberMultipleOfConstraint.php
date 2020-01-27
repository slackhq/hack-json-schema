<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace HH\Lib\Math;
use namespace Slack\Hack\JsonSchema;

const float COMPARISON_LEEWAY = 10. ** -6;

class NumberMultipleOfConstraint {
  public static function check(num $dividend, num $devisor, string $pointer): void {
    invariant($devisor > 0, 'multipleOf 0 or a negative number does not make sense. Use a positive non-zero number.');

    $remainer = Math\abs(
      $dividend is int && $devisor is int ? $dividend % $devisor : \fmod((float)$dividend, (float)$devisor),
    );
    \var_dump(dict[
      'div' => $dividend,
      'dev' => $devisor,
      'res' => $remainer,
      'rem min dev' => $remainer - $devisor,
      'left' => $remainer > (1 * 10 ** -6),
      'right' => ($remainer - $devisor) > (1 * 10 ** -6),
    ]);

    $error = shape(
      'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
      'constraint' => shape(
        'type' => JsonSchema\FieldErrorConstraint::MULTIPLE_OF,
        'expected' => $devisor,
        'got' => $dividend,
      ),
      'message' => "must be a multiple of {$devisor}",
    );

    if ($remainer is int && $remainer !== 0) {
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
    if ($remainer is float) {
      if ($remainer < $devisor / 2 && $remainer > COMPARISON_LEEWAY) {
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      } else if ($remainer > $devisor / 2 && ($devisor - $remainer) > COMPARISON_LEEWAY) {
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      }
    }
  }
}
