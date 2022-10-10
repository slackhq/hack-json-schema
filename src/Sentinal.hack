namespace Slack\Hack\JsonSchema;

/**
 * Represents an unset value.
 */
final class Sentinal {

    /**
     * The singleton instance of the sentinal value.
     */
    public static function get(): this {
        return new self();
    }

    private function __construct () {}
}
