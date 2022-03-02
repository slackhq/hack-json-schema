<?hh // strict

namespace Slack\Hack\JsonSchema\Constraints;

use namespace Slack\Hack\JsonSchema;

/**
 * Assert the input is a valid value for a Hack enum.
 *
 * This is ideally *not* a replacement for the `enum` constraint, but should instead
 * be used alongside it: that way, generated code in different languages (i.e, not
 * in Hack) will still pass valid enum values. However, there are instances when an
 * enum simply has so many values that leveraging the `enum` constraint becomes unwieldy,
 * and `hackEnum` may still be preferable to manually-written validation in those cases.
 */
final class HackEnumConstraint {
    public static function check<T as arraykey>(mixed $input, \HH\enumname<T> $enum_class, string $pointer): T {
        $typed = $enum_class::coerce($input);
        if ($typed is nonnull) {
            return $typed;
        }

        $error = shape(
            'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
            'constraint' => shape(
                'type' => JsonSchema\FieldErrorConstraint::ENUM,
                'expected' => keyset($enum_class::getNames()),
                'got' => $input,
            ),
            'message' => 'must be a valid enum value',
        );
        throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
    }
}