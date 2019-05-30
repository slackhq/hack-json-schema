<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace Slack\Hack\JsonSchema;

use type \Facebook\HackCodegen\{
  CodegenShape,
  CodegenProperty,
  CodegenMethod,
  HackBuilderValues,
};

type TNullSchema = shape(
  'type' => TSchemaType,
  ...
);

class NullBuilder extends BaseBuilder<TNullSchema> {
  protected static string $schema_name =
    'Slack\Hack\JsonSchema\Codegen\TNullSchema';

  public function build(): this {
    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod());

    $properties = [];

    $class->addProperties($properties);
    $this->addBuilderClass($class);

    return $this;
  }

  protected function getCheckMethod(): CodegenMethod {
    $hb = $this->getHackBuilder()
      ->addAssignment(
        '$typed',
        'Constraints\NullConstraint::check($input, $pointer)',
        HackBuilderValues::literal(),
      )
      ->ensureEmptyLine();

    $hb->addReturn('$typed', HackBuilderValues::literal());

    return $this->codegenCheckMethod()
      ->addParameters(['mixed $input', 'string $pointer'])
      ->setBody($hb->getCode())
      ->setReturnType($this->getType());
  }

  public function getType(): string {
    return 'mixed';
  }

}
