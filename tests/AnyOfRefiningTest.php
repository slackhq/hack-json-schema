<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\{
  AnyOfValidator1,
  AnyOfValidator2,
  AnyOfValidator3,
  AnyOfValidator4,
  AnyOfValidatorManyShapes,
  AnyOfValidatorNestedNullableAnyOf,
  AnyOfValidatorNestedShapes,
  AnyOfValidatorNullableArraykey,
  AnyOfValidatorNullableNestedShapes,
  AnyOfValidatorNullableStrings,
  AnyOfValidatorOpenAndClosedShapes,
  AnyOfValidatorOpenShapes,
  AnyOfValidatorRefShapes,
  AnyOfValidatorRequiredShapeProperties,
  AnyOfValidatorShapes,
  AnyOfValidatorShapesDisjoint,
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
    $ret = self::getBuilder('anyof-schema-strings.json', 'AnyOfValidatorStrings', shape(
      'refs' => shape(
        'unique' => shape(
          'source_root' => __DIR__,
          'output_root' => __DIR__.'/examples/codegen',
        ),
      ),
    ));
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-many-shapes.json', 'AnyOfValidatorManyShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nested-nullable-anyof.json', 'AnyOfValidatorNestedNullableAnyOf');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nullable-arraykey.json', 'AnyOfValidatorNullableArraykey');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nullable-vec.json', 'AnyOfValidatorNullableVec');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nullable-strings.json', 'AnyOfValidatorNullableStrings');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nested-shapes.json', 'AnyOfValidatorNestedShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-nullable-nested-shapes.json', 'AnyOfValidatorNullableNestedShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-open-and-closed-shapes.json', 'AnyOfValidatorOpenAndClosedShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-open-shapes.json', 'AnyOfValidatorOpenShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-ref-shapes.json', 'AnyOfValidatorRefShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-required-shape-properties.json', 'AnyOfValidatorRequiredShapeProperties');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-shapes.json', 'AnyOfValidatorShapes');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-shapes-disjoint.json', 'AnyOfValidatorShapesDisjoint');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-shapes-disabled.json', 'AnyOfValidatorShapesDisabled');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-schema-vecs.json', 'AnyOfValidatorVecs');
    $ret['codegen']->build();
    $ret = self::getBuilder('anyof-nested-anyof.json', 'AnyOfNestedAnyOf');
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

  public function testAnyOfValidatorManyShapes(): void {
    $this->expectType<shape(
      ?'foo' => ?int,
      ?'bar' => string,
      ?'baz' => bool,
    )>(AnyOfValidatorManyShapes::class);
  }

  public function testAnyOfValidatorNestedShapes(): void {
    $this->expectType<shape(
      ?'foo' => shape(
        ?'baz' => arraykey,
        ?'qux' => bool,
      ),
      ...
    )>(AnyOfValidatorNestedShapes::class);
  }

  public function testAnyOfValidatorNullableNestedShapes(): void {
    $this->expectType<shape(
      ?'foo' => ?shape(
        ?'baz' => arraykey,
        ?'qux' => bool,
      ),
      ...
    )>(AnyOfValidatorNullableNestedShapes::class);
  }

  public function testAnyOfValidatorOpenAndClosedShapes(): void {
    $this->expectType<shape(
      ?'foo' => arraykey,
      ?'bar' => vec<int>,
      ...
    )>(AnyOfValidatorOpenAndClosedShapes::class);
  }

  public function testAnyOfValidatorOpenShapes(): void {
    $this->expectType<shape(
      ?'foo' => arraykey,
      ...
    )>(AnyOfValidatorOpenShapes::class);
  }

  public function testAnyOfValidatorRefShapes(): void {
    $this->expectType<shape(
      ?'foo' => vec<arraykey>,
      ?'baz' => nonnull,
      ...
    )>(AnyOfValidatorRefShapes::class);
  }

  public function testAnyOfValidatorRequiredShapeProperties(): void {
    $this->expectType<shape(
      'foo' => arraykey,
      ?'bar' => vec<arraykey>,
      ...
    )>(AnyOfValidatorRequiredShapeProperties::class);
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

  public function testAnyOfValidatorShapesDisjoint(): void {
    $this->expectType<mixed>(AnyOfValidatorShapesDisjoint::class);
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
