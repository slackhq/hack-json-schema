<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use namespace HH\Lib\C;
use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\{IgnoreRefsValidator};

final class IgnoreRefsValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('ignore-refs.json', 'IgnoreRefsValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testInvalidEmptyInput(): void {
    $validator = new IgnoreRefsValidator(dict['randomprop' => 'IanIzzy']);
    $validator->validate();
    expect($validator->isValid())->toBeTrue();
  }
}
