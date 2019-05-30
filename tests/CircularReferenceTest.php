<?hh

namespace Slack\Hack\JsonSchema\Tests;

use namespace Slack\Hack\JsonSchema;
use function Facebook\FBExpect\expect;

final class CircularReferenceTest extends BaseCodegenTestCase {

  public function testSimpleLoop(): void {
    $ret = self::getBuilder(
      '../external_examples/loop-schema.json',
      'CircularValidator',
    );
    expect(() ==> $ret['codegen']->build())->toThrow(
      JsonSchema\CircularReferenceException::class,
    );
  }

  public function testObjectiveLoop(): void {
    $ret = self::getBuilder(
      '../external_examples/loop-schema2.json',
      'CircularValidator',
    );
    expect(() ==> $ret['codegen']->build())->toThrow(
      JsonSchema\CircularReferenceException::class,
    );
  }

  public function testDoubleObjectiveLoop(): void {
    $ret = self::getBuilder(
      '../external_examples/loop-schema3.json',
      'CircularValidator',
    );
    expect(() ==> $ret['codegen']->build())->toThrow(
      JsonSchema\CircularReferenceException::class,
    );
  }

  public function testSimpleandObjectiveLoop(): void {
    $ret = self::getBuilder(
      '../external_examples/loop-schema6.json',
      'CircularValidator',
    );
    expect(() ==> $ret['codegen']->build())->toThrow(
      JsonSchema\CircularReferenceException::class,
    );
  }

}
