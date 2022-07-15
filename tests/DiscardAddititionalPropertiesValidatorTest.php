<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;

use function Facebook\FBExpect\expect;

use type Slack\Hack\JsonSchema\Tests\Generated\DiscardAddititionalPropertiesValidator;

final class DiscardAddititionalPropertiesValidatorTest extends BaseCodegenTestCase {

  <<__Override>>
  public static async function beforeFirstTestAsync(): Awaitable<void> {
    $ret = self::getBuilder(
      'discard-additional-properties-schema.json',
      'DiscardAddititionalPropertiesValidator',
    );
    $ret['codegen']->build();
    require_once($ret['path']);
  }

  public function testDoesNotRemoveAllowedAdditionalProperties(): void {
    $validator = new DiscardAddititionalPropertiesValidator(dict[
      'only_additional_properties' => dict[
        'value' => 'string',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $output = $validator->getValidatedInput();
    $result = $output['only_additional_properties'] ?? null as nonnull;
    expect($result)->toContainKey('value');

  }

  public function testRemovesNotAllowedAdditionalProperties(): void {
    $validator = new DiscardAddititionalPropertiesValidator(dict[
      'only_properties' => dict[
        'required_string' => 'This is required',
        'number' => 3,
        'additional' => 'this field is not defined the json spec',
      ],
    ]);

    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    // Convert the return shape to a dictionary to do assertions without running
    // into the type-checker saying "no, you can't do that!"
    $res = $validator->getValidatedInput()['only_properties'] ?? null as nonnull;
    $res = Shapes::toDict($res);

    expect($res)->toContainKey('required_string');
    expect($res)->toNotContainKey('additional');
    expect($res['number'])->toBeSame(3);
  }

  public function testAdditionalProperitesRef(): void {
    $input = dict[
      'additional_properties_ref' => dict[
        'something' => dict[
          'something-else' => varray['array', 'of', 'strings'],
        ],
      ],
    ];

    $validator = new DiscardAddititionalPropertiesValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeTrue();

    $input = dict[
      'additional_properties_ref' => dict[
        'something' => dict[
          'something-else' => varray[34, 'of', 'strings'],
        ],
      ],
    ];

    $validator = new DiscardAddititionalPropertiesValidator($input);
    $validator->validate();
    expect($validator->isValid())->toBeFalse();
  }

}
