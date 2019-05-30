<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<f034254e6745db977dfac731adfd670c>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

<<Codegen>>
final class ExternalExamplesFriendsSchema
  extends JsonSchema\BaseValidator<vec<TExternalExamplesFriendsSchemaDefinitionsPerson>> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TExternalExamplesFriendsSchemaDefinitionsPerson> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExternalExamplesFriendsSchemaDefinitionsPerson::check(
          $value,
          JsonSchema\get_pointer($pointer, (string) $index),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }

  final protected function process(
  ): vec<TExternalExamplesFriendsSchemaDefinitionsPerson> {
    return self::check($this->input, $this->pointer);
  }
}
