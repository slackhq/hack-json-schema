<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\{
  AnyOfValidator1,
  AnyOfValidator2,
  AnyOfValidator3,
  AnyOfValidator4,
  AnyOfValidatorNestedNullableAnyOf,
  AnyOfValidatorNullableArraykey,
  AnyOfValidatorNullableStrings,
  AnyOfValidatorShapes,
  AnyOfValidatorStrings,
  AnyOfValidatorVecs,
};

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
    $ret = self::getBuilder('anyof-schema-strings.json', 'AnyOfValidatorStrings');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nested-nullable-anyof.json', 'AnyOfValidatorNestedNullableAnyOf');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nullable-arraykey.json', 'AnyOfValidatorNullableArraykey');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nullable-vec.json', 'AnyOfValidatorNullableVec');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nullable-strings.json', 'AnyOfValidatorNullableStrings');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-shapes.json', 'AnyOfValidatorShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-vecs.json', 'AnyOfValidatorVecs');
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

  public function testAnyofValidatorStrings(): void {
    $this->expectCases(
      vec[
        shape(
          // Can be shorter than 11 chars
          'input' => 'abcdefghij',
          'output' => 'abcdefghij',
          'valid' => true,
        ),
        shape(
          // Can be longer than 11 chars
          'input' => 'abcdefghijkl',
          'output' => 'abcdefghijkl',
          'valid' => true,
        ),
        shape(
          // Cannot be 11 chars
          'input' => 'abcdefghijk',
          'valid' => false,
        ),
        shape(
          // Cannot be null
          'input' => null,
          'valid' => false,
        ),
      ],
      $input ==> new AnyOfValidatorStrings($input),
    );
  }

  public function testAnyofValidatorNullableAnyOf(): void {
    $this->expectCases(
      vec[
        shape(
          'input' => 1,
          'output' => 1,
          'valid' => true,
        ),
        shape(
          'input' => 1.1,
          'output' => 1.1,
          'valid' => true,
        ),
        shape(
          'input' => null,
          'output' => null,
          'valid' => true,
        ),
        shape(
          'input' => 'foo',
          'valid' => false,
        ),
      ],
      $input ==> new AnyOfValidatorNestedNullableAnyOf($input),
    );
  }

  public function testAnyofValidatorNullableArraykey(): void {
    $this->expectCases(
      vec[
        shape(
          'input' => 1,
          'output' => 1,
          'valid' => true,
        ),
        shape(
          'input' => 'foo',
          'output' => 'foo',
          'valid' => true,
        ),
        shape(
          'input' => null,
          'output' => null,
          'valid' => true,
        ),
        shape(
          'input' => 1.1,
          'valid' => false,
        ),
      ],
      $input ==> new AnyOfValidatorNullableArraykey($input),
    );
  }

  public function testAnyofValidatorNullableStrings(): void {
    $this->expectCases(
      vec[
        shape(
          'input' => 1,
          'valid' => false,
        ),
        shape(
          'input' => 'foo',
          'output' => 'foo',
          'valid' => true,
        ),
        shape(
          'input' => null,
          'output' => null,
          'valid' => true,
        ),
        shape(
          'input' => 1.1,
          'valid' => false,
        ),
      ],
      $input ==> new AnyOfValidatorNullableStrings($input),
    );
  }

  public function testAnyofValidatorShapes(): void {
    $this->expectCases(
      vec[
        shape(
          'input' => shape('bar' => vec[1, 2, 3], 'foo' => 3),
          'output' => shape('foo' => 3, 'bar' => vec[1, 2, 3]),
          'valid' => true,
        ),
        shape(
          'input' => shape('bar' => vec[1, 2, 3]),
          'output' => shape('bar' => vec[1, 2, 3]),
          'valid' => true,
        ),
        shape(
          'input' => shape('foo' => 3),
          'valid' => false,
        ),
        shape(
          'input' => 'foo',
          'valid' => false,
        ),
        shape(
          'input' => null,
          'valid' => false,
        ),
      ],
      $input ==> new AnyOfValidatorShapes($input),
    );
  }

  public function testAnyofValidatorVecs(): void {
    $this->expectCases(
      vec[
        shape(
          'input' => vec[null, null],
          'output' => vec[null, null],
          'valid' => true,
        ),
        shape(
          'input' => vec[1, 2],
          'output' => vec[1, 2],
          'valid' => true,
        ),
        shape(
          'input' => vec['abcdef', 'befg'],
          'output' => vec['abcdef', 'befg'],
          'valid' => true,
        ),
        shape(
          'input' => null,
          'valid' => false,
        ),
        shape(
          'input' => shape('foo' => 1),
          'output' => vec[1], // Somewhat surprisingly this works
          'valid' => true,
        ),
        shape(
          'input' => shape('foo' => 1.3),
          'valid' => false,
        ),
        shape(
          'input' => vec[1.1, 1.2, 1.3],
          'valid' => false,
        ),
      ],
      $input ==> new AnyOfValidatorVecs($input),
    );
  }
}
