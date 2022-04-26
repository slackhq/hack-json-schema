<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\Str;
use type Facebook\HackCodegen\{CodegenMethod, HackBuilderValues};

type TNumberSchema = shape(
  'type' => TSchemaType,
  ?'maximum' => int,
  ?'minimum' => int,
  ?'coerce' => bool,
  ?'multipleOf' => num,
  ?'hackEnum' => string,
  ...
);

class NumberBuilder extends BaseBuilder<TNumberSchema> {
  protected static string $schema_name = 'Slack\Hack\JsonSchema\Codegen\TNumberSchema';

  <<__Override>>
  public function build(): this {
    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod());

    $properties = vec[];
    $maximum = $this->typed_schema['maximum'] ?? null;
    if ($maximum is nonnull) {
      $properties[] = $this->codegenProperty('maximum')
        ->setType('int')
        ->setValue($maximum, HackBuilderValues::export());
    }

    $minimum = $this->typed_schema['minimum'] ?? null;
    if ($minimum is nonnull) {
      $properties[] = $this->codegenProperty('minimum')
        ->setType('int')
        ->setValue($minimum, HackBuilderValues::export());
    }

    $devisor = $this->typed_schema['multipleOf'] ?? null;
    if ($devisor is nonnull) {
      $properties[] = $this->codegenProperty('devisorForMultipleOf')
        ->setType('num')
        ->setValue($devisor, HackBuilderValues::export());
    }


    $enum = $this->getEnumCodegenProperty();
    if ($enum is nonnull) {
      $properties[] = $enum;
    }

    $coerce = $this->typed_schema['coerce'] ?? $this->ctx->getCoerceDefault();
    $properties[] = $this->codegenProperty('coerce')
      ->setType('bool')
      ->setValue($coerce, HackBuilderValues::export());

    $class->addProperties($properties);
    $this->addBuilderClass($class);

    return $this;
  }

  protected function getCheckMethod(): CodegenMethod {
    $hb = $this->getHackBuilder();

    $return_type = $this->getType();
    if ($this->typed_schema['type'] === TSchemaType::INTEGER_T) {
      $type_constraint = 'Constraints\IntegerConstraint';
    } else {
      $type_constraint = 'Constraints\NumberConstraint';
    }

    $hb
      ->addAssignment(
        '$typed',
        "{$type_constraint}::check(\$input, \$pointer, self::\$coerce)",
        HackBuilderValues::literal(),
      )
      ->ensureEmptyLine();

    $this->addEnumConstraintCheck($hb);

    if (($this->typed_schema['maximum'] ?? null) is nonnull) {
      $hb->addMultilineCall('Constraints\NumberMaximumConstraint::check', vec['$typed', 'self::$maximum', '$pointer']);
    }

    if (($this->typed_schema['minimum'] ?? null) is nonnull) {
      $hb->addMultilineCall('Constraints\NumberMinimumConstraint::check', vec['$typed', 'self::$minimum', '$pointer']);
    }

    if (($this->typed_schema['multipleOf'] ?? null) is nonnull) {
      $hb->addMultilineCall(
        'Constraints\NumberMultipleOfConstraint::check',
        vec['$typed', 'self::$devisorForMultipleOf', '$pointer'],
      );
    }

    if ($this->typed_schema['type'] === TSchemaType::INTEGER_T) {
      $this->addHackEnumConstraintCheck($hb);
    }

    $hb->addReturn('$typed', HackBuilderValues::literal());

    return $this->codegenCheckMethod()
      ->addParameters(vec['mixed $input', 'string $pointer'])
      ->setBody($hb->getCode())
      ->setReturnType($return_type);
  }

  <<__Override>>
  public function getType(): string {
    if ($this->typed_schema['type'] === TSchemaType::INTEGER_T) {
      if (Shapes::keyExists($this->typed_schema, 'hackEnum')) {
        return Str\format('\%s', $this->typed_schema['hackEnum']);
      }
      return 'int';
    }
    return 'num';
  }

  <<__Override>>
  public function getTypeInfo(): Typing\Type {
    if ($this->getType() === 'int') {
      return Typing\TypeSystem::int();
    } else if ($this->getType() === 'num') {
      return Typing\TypeSystem::num();
    } else {
      // TODO: Handle hackEnum
      return Typing\TypeSystem::nonnull();
    }
  }
}
