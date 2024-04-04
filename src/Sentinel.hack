namespace Slack\Hack\JsonSchema;

/**
 * Represents an unset value.
 */
final class Sentinel {

  /**
   * The singleton instance of the sentinal value.
   */
  <<__Memoize>>
  public static function get(): this {
    return new self();
  }

  private function __construct() {}
}
