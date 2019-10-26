<?hh // partial

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;
use type Facebook\HackTest\DataProvider;


final class EmptySchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('empty-schema.json', 'EmptySchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function provideMixedData(): vec<(mixed)> {
    return vec[
      tuple(1),
      tuple('1'),
      tuple(vec[]),
      tuple(dict[]),
      tuple(darray[]),
      tuple(varray[]),
      tuple(Vector {}),
      tuple(Map {}),
      tuple(Set {}),
      tuple(keyset[]),
      tuple(new \stdClass()),
      tuple(false),
      tuple(null),
    ];
  }

  <<DataProvider('provideMixedData')>>
  public function testTrue(mixed $value): void {
    expect(() ==> {
      $schema = new Generated\EmptySchemaValidator($value);
      $schema->validate();
      return $schema->getValidatedInput();
    })->notToThrow('Anything should get passed the empty schema');
  }

}
