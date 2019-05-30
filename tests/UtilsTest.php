<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;
use type Facebook\HackTest\HackTest;
use function Slack\Hack\JsonSchema\get_pointer;

class UtilsTest extends HackTest {

  /**
  * Test `get_pointer` against RFC examples:
  * https://tools.ietf.org/html/rfc6901#section-5
  */
  public function testGetPointer(): void {
    $ret = get_pointer('', 'foo');
    expect($ret)->toBeSame('/foo');

    $ret = get_pointer(get_pointer('', 'foo'), (string)0);
    expect($ret)->toBeSame('/foo/0');

    $ret = get_pointer('', '');
    expect($ret)->toBeSame('/');

    $ret = get_pointer('', 'a/b');
    expect($ret)->toBeSame('/a~1b');

    $ret = get_pointer('', 'c%d');
    expect($ret)->toBeSame('/c%d');

    $ret = get_pointer('', 'e^f');
    expect($ret)->toBeSame('/e^f');

    $ret = get_pointer('', 'g|h');
    expect($ret)->toBeSame('/g|h');

    $ret = get_pointer('', 'i\\j');
    expect($ret)->toBeSame('/i\\j');

    $ret = get_pointer('', "k\"1");
    expect($ret)->toBeSame("/k\"1");

    $ret = get_pointer('', ' ');
    expect($ret)->toBeSame('/ ');

    $ret = get_pointer('', 'm~n');
    expect($ret)->toBeSame('/m~0n');

    $ret = get_pointer('', 'foo', 'bar', 'baz');
    expect($ret)->toBeSame('/foo/bar/baz');

    $ret = get_pointer('/foo', 'bar', 'baz');
    expect($ret)->toBeSame('/foo/bar/baz');
  }

}
