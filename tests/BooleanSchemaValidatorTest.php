<?hh // partial

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\BooleanSchemaValidator;

final class BooleanSchemaValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder('boolean-schema.json', 'BooleanSchemaValidator');
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testSimpleValid(): void {
    $validator = new BooleanSchemaValidator(dict[
      'simple' => false,
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();
  }

  public function testSimpleInvalid(): void {
    $validator = new BooleanSchemaValidator(dict[
      'simple' => 'false',
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeFalse();
  }

  public function testCoerceValid(): void {
    $cases = vec[
      shape(
        'input' => '0',
        'output' => false,
      ),
      shape(
        'input' => '1',
        'output' => true,
      ),
      shape(
        'input' => 'yes',
        'output' => true,
      ),
      shape(
        'input' => true,
        'output' => true,
      ),
      shape(
        'input' => false,
        'output' => false,
      ),
      shape('input' => 0, 'output' => false),
      shape('input' => 1, 'output' => true),
    ];

    foreach ($cases as $case) {
      $validator = new BooleanSchemaValidator(dict[
        'coerce' => $case['input'],
      ]);
      $validator->validate();

      expect($validator->isValid())->toBeTrue(
        "should be valid for input: '{$case['input']}'",
      );

      $validated = $validator->getValidatedInput();
      expect($validated)->toNotBeNull('should be valid');

      expect($validated['coerce'] ?? null)->toBeSame(
        $case['output'],
        "should equal output for input: '{$case['input']}'",
      );
    }

  }

}
