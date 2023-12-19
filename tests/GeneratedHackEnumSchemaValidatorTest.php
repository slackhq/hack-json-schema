<?hh // strict

namespace Slack\Hack\JsonSchema\Tests;


use type Slack\Hack\JsonSchema\Tests\Generated\EnumSchemaValidator;

final class GeneratedHackEnumSchemaValidatorTest extends BaseCodegenTestCase {

	<<__Override>>
	public static async function beforeFirstTestAsync(): Awaitable<void> {
		$ret = self::getBuilder('generated-hack-enum-schema.json', 'GeneratedHackEnumSchemaValidator');
		$ret['codegen']->build();
		require_once($ret['path']);
	}
}
