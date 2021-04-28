<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;


use type Facebook\HackCodegen\{CodegenMethod, HackBuilderValues};

type TNullSchema = shape(
  'type' => TSchemaType,
  ...
);

class NullBuilder extends BaseBuilder<TNullSchema> {
  protected static string $schema_name = 'Slack\Hack\JsonSchema\Codegen\TNullSchema';

  <<__Override>>
  public function build(): this {
    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod());

    $properties = vec[];

    $class->addProperties($properties);
    $this->addBuilderClass($class);

    return $this;
  }

  protected function getCheckMethod(): CodegenMethod {
    $hb = $this->getHackBuilder()
      ->addAssignment('$typed', 'Constraints\NullConstraint::check($input, $pointer)', HackBuilderValues::literal())
      ->ensureEmptyLine();

    $hb->addReturn('$typed', HackBuilderValues::literal());

    return $this->codegenCheckMethod()
      ->addParameters(vec['mixed $input', 'string $pointer'])
      ->setBody($hb->getCode())
      ->setReturnType($this->getType());
  }

  <<__Override>>
  public function getType(): string {
    return 'mixed';
  }

}
