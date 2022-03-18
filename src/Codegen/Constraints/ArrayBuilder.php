<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use type Facebook\HackCodegen\{CodegenMethod, HackBuilder, HackBuilderValues};

type TArraySchema = shape(
  'type' => TSchemaType,
  ?'items' => mixed,
  ?'additionalItems' => bool,
  ?'maxItems' => int,
  ?'minItems' => int,
  ?'coerce' => bool,
  ...
);

type TArraySchemaItemsSingleSchema = TSchema;
type TArraySchemaItemsMultiSchema = vec<TSchema>;

enum HackArrayType: string {
  VEC = 'vec';
  KEYSET = 'keyset';
}

class ArrayBuilder extends BaseBuilder<TArraySchema> {
  private ?IBuilder $singleItemSchemaBuilder = null;
  protected static string $schema_name = 'Slack\Hack\JsonSchema\Codegen\TArraySchema';
  private HackArrayType $hackArrayType = HackArrayType::VEC;

  <<__Override>>
  public function build(): this {
    $this->setupSingleItemSchemaBuilder();
    $this->determineHackArrayType();

    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod());

    $properties = vec[];
    $max_items = $this->typed_schema['maxItems'] ?? null;
    if ($max_items is nonnull) {
      $properties[] = $this->codegenProperty('maxItems')
        ->setType('int')
        ->setValue($max_items, HackBuilderValues::export());
    }

    $min_items = $this->typed_schema['minItems'] ?? null;
    if ($min_items is nonnull) {
      $properties[] = $this->codegenProperty('minItems')
        ->setType('int')
        ->setValue($min_items, HackBuilderValues::export());
    }

    $coerce = $this->typed_schema['coerce'] ?? $this->ctx->getCoerceDefault();
    $properties[] = $this->codegenProperty('coerce')
      ->setType('bool')
      ->setValue($coerce, HackBuilderValues::export());

    $class->addProperties($properties);
    $this->addBuilderClass($class);

    return $this;
  }

  <<__Override>>
  public function getType(): string {
    // Items can be many types, best we can do is `vec<mixed>`.
    if (!$this->isSchema($this->typed_schema['items'] ?? null)) {
      return 'vec<mixed>';
    }

    // Items is a single type, get the type from the items builder.
    $items_builder = $this->singleItemSchemaBuilder;
    invariant($items_builder is nonnull, 'must call `build` method before accessing type');
    return "{$this->hackArrayType}<{$items_builder->getType()}>";
  }

  protected function getCheckMethod(): CodegenMethod {
    $hb = $this->getHackBuilder()
      ->addAssignment(
        '$typed',
        'Constraints\ArrayConstraint::check($input, $pointer, self::$coerce)',
        HackBuilderValues::literal(),
      )
      ->ensureEmptyLine();

    $max_items = $this->typed_schema['maxItems'] ?? null;
    $min_items = $this->typed_schema['minItems'] ?? null;

    if ($max_items is nonnull || $min_items is nonnull) {
      $hb->addAssignment('$length', '\HH\Lib\C\count($typed)', HackBuilderValues::literal());
    }

    if ($max_items is nonnull) {
      $hb->addMultilineCall(
        'Constraints\ArrayMaxItemsConstraint::check',
        vec['$length', 'self::$maxItems', '$pointer'],
      );
    }

    if ($min_items is nonnull) {
      $hb->addMultilineCall(
        'Constraints\ArrayMinItemsConstraint::check',
        vec['$length', 'self::$minItems', '$pointer'],
      );
    }

    $items = $this->typed_schema['items'] ?? null;
    if ($items is nonnull) {
      $this->buildItems($items, $hb, $this->typed_schema['additionalItems'] ?? true);
    } else {
      $hb->addReturn('$typed', HackBuilderValues::literal());
    }

    return $this->codegenCheckMethod()
      ->addParameters(vec['mixed $input', 'string $pointer'])
      ->setBody($hb->getCode())
      ->setReturnType($this->getType());
  }

  private function buildItems(mixed $items, HackBuilder $hb, bool $additionalItems): void {
    if ($items === null) {
      return;
    }

    $hb
      ->addAssignment('$output', 'vec[]', HackBuilderValues::literal());

    if ($this->isSchema($items)) {
      $this->buildItemsSingleSchema($hb);
    } else {
      $schemas = type_assert_shape($items, 'Slack\Hack\JsonSchema\Codegen\TArraySchemaItemsMultiSchema');
      $this->buildItemsMultiSchema($schemas, $hb, $additionalItems);
    }

    $hb->addReturn('$output', HackBuilderValues::literal());
  }

  /**
  *
  * The array of items is all the same type. Generate a for loop to iterate
  * through the input, validating each item.
  *
  */
  private function buildItemsSingleSchema(HackBuilder $hb): void {
    $items_class_name = $this->singleItemSchemaBuilder?->getClassName() as nonnull;

    $hb
      ->addAssignment('$errors', 'vec[]', HackBuilderValues::literal())
      ->ensureEmptyLine();

    $hb
      ->startForeachLoop('$typed', '$index', '$value')
      ->startTryBlock()
      ->addMultilineCall(
        "\$output[] = {$items_class_name}::check",
        vec['$value', 'JsonSchema\get_pointer($pointer, (string) $index)'],
      )
      ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
      ->addLine('$errors = \HH\Lib\Vec\concat($errors, $e->errors);')
      ->endTryBlock()
      ->endForeachLoop()
      ->ensureEmptyLine();

    $hb
      ->startIfBlock('\HH\Lib\C\count($errors)')
      ->addLine('throw new JsonSchema\InvalidFieldException($pointer, $errors);')
      ->endIfBlock()
      ->ensureEmptyLine();

    if ($this->hackArrayType === HackArrayType::KEYSET) {
      $hb
        ->addMultilineCall(
          '$output = Constraints\ArrayUniqueItemsConstraint::check',
          vec['$output', '$pointer', 'self::$coerce'],
        )
        ->ensureEmptyLine();
    }
  }

  /**
  *
  * Each item in the array has its own schema specified. Generate an array of
  * constraints based on the defined schemas, then generate a for loop where we
  * validate each input with its corresponding schema.
  *
  */
  private function buildItemsMultiSchema(
    TArraySchemaItemsMultiSchema $schemas,
    HackBuilder $hb,
    bool $additionalItems,
  ): void {

    $constraints = vec[];
    foreach ($schemas as $index => $schema) {
      $schema_builder =
        new SchemaBuilder($this->ctx, $this->generateClassName('items', $this->suffix, (string)$index), $schema);
      $schema_builder->build();

      $constraints[] = "{$schema_builder->getClassName()}::check<>";
    }

    $hb
      ->addAssignment('$errors', 'vec[]', HackBuilderValues::literal())
      ->addAssignment('$constraints', $constraints, HackBuilderValues::vec(HackBuilderValues::literal()))
      ->ensureEmptyLine();

    $hb
      ->startForeachLoop('$typed', '$index', '$value')
      ->startTryBlock()
      ->startIfBlock('$index < \HH\Lib\C\count($constraints)')
      ->addAssignment('$constraint', '$constraints[$index]', HackBuilderValues::literal())
      ->addMultilineCall('$output[] = $constraint', vec['$value', 'JsonSchema\get_pointer($pointer, (string) $index)'])
      ->addElseBlock();

    if (!$additionalItems) {
      $error = shape(
        'code' => 'JsonSchema\FieldErrorCode::INVALID_TYPE',
        'message' => '\'additional items not allowed in array\'',
      );
      $hb
        ->addAssignment('$error', $error, HackBuilderValues::shapeWithUniformRendering(HackBuilderValues::literal()))
        ->addLine('throw new JsonSchema\\InvalidFieldException($pointer, vec[$error]);');
    } else {
      $hb
        ->addLine('$output[] = $value;');
    }

    $hb
      ->endIfBlock()
      ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
      ->addLine('$errors = \HH\Lib\Vec\concat($errors, $e->errors);')
      ->endTryBlock()
      ->endForeachLoop()
      ->ensureEmptyLine();

    $hb
      ->startIfBlock('\HH\Lib\C\count($errors)')
      ->addLine('throw new JsonSchema\InvalidFieldException($pointer, $errors);')
      ->endIfBlock()
      ->ensureEmptyLine();
  }

  private function isSchema(mixed $items): bool {
    return is_dict($items);
  }

  /**
   * Setup the singleItemSchemaBuilder, if necessary.
   *
   * This should be the first thing we do in `build()`, since subsequent
   * logic depends on the single item schema builder.
   */
  private function setupSingleItemSchemaBuilder(): void {
    $items = $this->typed_schema['items'] ?? null;
    if ($this->isSchema($items)) {
      $schema = type_assert_shape($items, 'Slack\Hack\JsonSchema\Codegen\TArraySchemaItemsSingleSchema');
      $items_builder = new SchemaBuilder($this->ctx, $this->generateClassName($this->suffix, 'items'), $schema);
      $items_builder->build();
      $this->singleItemSchemaBuilder = $items_builder;
    }
  }

  /**
   * Determine the type of hack array we will generate.
   */
  private function determineHackArrayType(): void {
    if ($this->schema['uniqueItems'] ?? false) {
      $item_type = $this->singleItemSchemaBuilder?->getType();
      if ($item_type === 'string' || $item_type === 'int') {
        $this->hackArrayType = HackArrayType::KEYSET;
      }
    }
  }

}
