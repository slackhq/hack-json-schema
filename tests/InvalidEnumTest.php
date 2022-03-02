<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

final class NotAnEnum {}

final class InvalidEnumTest extends BaseCodegenTestCase {

  public function testNotAnEnum(): void {
    $ret = self::getBuilderForSchema(
        shape(
            'type' => 'string',
            'hackEnum' => NotAnEnum::class
        ),
        'InvalidEnumValidator'
    );
    expect(() ==> $ret['codegen']->build())->toThrow(\HH\InvariantException::class);
  }

  public function testEnumAndHackEnum(): void {
    $ret = self::getBuilderForSchema(
        shape(
            'type' => 'string',
            'hackEnum' => TestStringEnum::class,
            'enum' => vec['qux']
        ),
        'InvalidEnumValidator'
    );
    expect(() ==> $ret['codegen']->build())->toThrow(\HH\InvariantException::class);
  }

  public function testMismatchedEnumType(): void {
    $ret = self::getBuilderForSchema(
        shape(
            'type' => 'string',
            'hackEnum' => TestIntEnum::class,
        ),
        'InvalidEnumValidator'
    );
    expect(() ==> $ret['codegen']->build())->toThrow(\HH\InvariantException::class);
  }
}