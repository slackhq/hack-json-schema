<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\{AnyOfValidator1, AnyOfValidator2, AnyOfValidator3, AnyOfValidator4};

final class AnyOfRefiningTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('anyof-schema-1.json', 'AnyOfValidator1');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-2.json', 'AnyOfValidator2');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-3.json', 'AnyOfValidator3');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-4.json', 'AnyOfValidator4');
    $ret['codegen']->build();
  }

  public function testNullableString(): void {

    $ret = self::getBuilder('anyof-schema-1.json', 'AnyOfValidator1');
    $ret['codegen']->build();
    $cf = $ret['codegen']->getFile();

    $validator = new AnyOfValidator1('ok');
    $validator->validate();

    $rendered = $cf->render();
    $this->assertUnchanged($rendered);

    expect($validator->isValid())->toBeTrue();
  }

  public function testMixedUnchanged(): void {

    $ret2 = self::getBuilder('anyof-schema-2.json', 'AnyOfValidator2');
    $ret2['codegen']->build();
    $cf = $ret2['codegen']->getFile();

    $validator = new AnyOfValidator2(2);
    $validator->validate();

    $rendered = $cf->render();
    $this->assertUnchanged($rendered);

    expect($validator->isValid())->toBeTrue();
  }

  public function testDoubleNull(): void {

    $ret3 = self::getBuilder('anyof-schema-3.json', 'AnyOfValidator3');
    $ret3['codegen']->build();
    $cf = $ret3['codegen']->getFile();

    $validator = new AnyOfValidator3(null);
    $validator->validate();

    $rendered = $cf->render();
    $this->assertUnchanged($rendered);

    expect($validator->isValid())->toBeTrue();
  }

  public function testNullableObject(): void {

    $ret4 = self::getBuilder('anyof-schema-4.json', 'AnyOfValidator4');
    $ret4['codegen']->build();
    $cf = $ret4['codegen']->getFile();

    $validator = new AnyOfValidator4(dict[
      'post-office-box' => 'ok',
    ]);
    $validator->validate();

    $rendered = $cf->render();
    $this->assertUnchanged($rendered);

    expect($validator->isValid())->toBeTrue();
  }


}
