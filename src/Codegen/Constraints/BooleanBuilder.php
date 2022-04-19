<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use type Facebook\HackCodegen\{CodegenMethod, HackBuilderValues};

type TBooleanSchema = shape(
  'type' => TSchemaType,
  ?'coerce' => bool,
  ...
);

class BooleanBuilder extends BaseBuilder<TBooleanSchema> {
  protected static string $schema_name = 'Slack\Hack\JsonSchema\Codegen\TBooleanSchema';

  <<__Override>>
  public function build(): this {

    $properties = vec[];

    $coerce = $this->typed_schema['coerce'] ?? $this->ctx->getCoerceDefault();
    $properties[] = $this->codegenProperty('coerce')
      ->setType('bool')
      ->setValue($coerce, HackBuilderValues::export());

    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod());
    $class->addProperties($properties);

    $this->addBuilderClass($class);
    return $this;
  }

  <<__Override>>
  public function getType(): string {
    return 'bool';
  }

  protected function getCheckMethod(): CodegenMethod {
    $hb = $this->getHackBuilder()
      ->addAssignment(
        '$typed',
        'Constraints\BooleanConstraint::check($input, $pointer, self::$coerce)',
        HackBuilderValues::literal(),
      )
      ->addReturn('$typed', HackBuilderValues::literal());

    return $this->codegenCheckMethod()
      ->addParameters(vec['mixed $input', 'string $pointer'])
      ->setBody($hb->getCode())
      ->setReturnType($this->getType());
  }

  <<__Override>>
  public function getTypeInfo(): Typing\Type {
    return Typing\TypeSystem::bool();
  }
}
