<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace HH\Lib\{Math, Str};
use namespace Slack\Hack\JsonSchema;

// Because comparing floating point numbers using `===` will have undesierable results,
// we will compare with a little bit of leeway.
// We are looking for a remainer of 0 after the modulo.
// `30 % 3` is 0, so 30 is a multiple of 3.
// `fmod(6., .6)` is not 0, because of floating point rounding errors.
// It is 2.220...E-16, but this is almost zero, so we pass the test.
const float COMPARISON_LEEWAY = 10. ** -6;

class NumberMultipleOfConstraint {
  public static function check(num $dividend, num $devisor, string $pointer): void {
    invariant($devisor > 0, 'multipleOf 0 or a negative number does not make sense. Use a positive non-zero number.');

    $remainer = Math\abs(
      $dividend is int && $devisor is int ? $dividend % $devisor : \fmod((float)$dividend, (float)$devisor),
    );

    $error = shape(
      'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
      'constraint' => shape(
        'type' => JsonSchema\FieldErrorConstraint::MULTIPLE_OF,
        'expected' => $devisor,
        'got' => $dividend,
      ),
      'message' => Str\format('must be a multiple of %s', (string)$devisor),
    );

    if ($remainer is int && $remainer !== 0) {
      throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
    if ($remainer is float) {
      // If we are closer to 0 than to the devisor, we check assert that our remainer
      // is less than our COMPARISON_LEEWAY.
      if ($remainer < $devisor / 2 && $remainer > COMPARISON_LEEWAY) {
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
        // However, sometimes the remainer is very close to the devisor.
        // That could also indicate a multiple of the devisor.
      } else if ($remainer > $devisor / 2 && ($devisor - $remainer) > COMPARISON_LEEWAY) {
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
      }
    }
  }
}
