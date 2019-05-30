<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace Slack\Hack\JsonSchema;

use type \Facebook\HackCodegen\{CodegenClass};
use namespace \HH\Lib\C;

enum TSchemaType: string {
  OBJECT_T = 'object';
  NUMBER_T = 'number';
  INTEGER_T = 'integer';
  STRING_T = 'string';
  ARRAY_T = 'array';
  BOOLEAN_T = 'boolean';
  NULL_T = 'null';
}

type TSchemaTypeVec = vec<TSchemaType>;

type TSchema = shape(
  ?'type' => mixed,
  ?'$ref' => string,
  ?'default' => mixed,
  ?'enum' => vec<mixed>,
  ...
);

class SchemaBuilder implements IBuilder {
  use Factory;
  use RefResolver;

  private IBuilder $builder;
  private TSchema $resolvedSchema;

  public function __construct(
    protected Context $ctx,
    string $suffix,
    protected TSchema $schema,
    ?CodegenClass $class = null,
  ) {
    $ref = $schema['$ref'] ?? null;
    $new_ctx = clone $this->ctx;

    // Resolve refs until we get to an actual schema

    $refs = keyset[];
    while ($ref is nonnull) {
      if (C\contains_key($refs, $ref))
        throw new JsonSchema\CircularReferenceException(
          "Circular reference beginning at {$ref}",
        );

      $refs[] = $ref;

      list($schema, $new_root) = $this->resolveRef($ref, $new_ctx);

      // If we resolve a reference, we may need to update what we consider the
      // root directory so if the resolved schema contains references we can
      // resolve them correctly.

      if ($new_root is nonnull) {
        $new_ctx->setRefsRootDirectory(\dirname($new_root));
        $new_root_schema = $this->loadSchema($new_root);
        invariant(
          $new_root_schema is nonnull,
          'Failed loading new root schema: %s',
          $new_root,
        );
        $new_ctx->setSchema($new_root_schema);
      }

      $ref = $schema['$ref'] ?? null;
    }

    // Set the resolved ref

    $this->resolvedSchema = $schema;

    // If unique refs is specified, use the UniqueRefBuilder to generate a class
    // for the specific ref.

    $unique_refs = $ctx->getUniqueRefsConfig();
    if ($unique_refs is nonnull && !C\is_empty($refs)) {
      $ref = C\last($refs) as nonnull;

      $builder = new UniqueRefBuilder($new_ctx, $ref, $schema);
      $this->builder = $builder;
      return;
    }

    $type = $schema['type'] ?? null;
    if ($type is nonnull) {
      if ($type is string) {
        $type = TSchemaType::assert($type);
        switch ($type) {
          case TSchemaType::OBJECT_T:
            $builder = new ObjectBuilder($new_ctx, $suffix, $schema, $class);
            break;
          case TSchemaType::INTEGER_T:
          case TSchemaType::NUMBER_T:
            $builder = new NumberBuilder($new_ctx, $suffix, $schema, $class);
            break;
          case TSchemaType::STRING_T:
            $builder = new StringBuilder($new_ctx, $suffix, $schema, $class);
            break;
          case TSchemaType::ARRAY_T:
            $builder = new ArrayBuilder($new_ctx, $suffix, $schema, $class);
            break;
          case TSchemaType::BOOLEAN_T:
            $builder = new BooleanBuilder($new_ctx, $suffix, $schema, $class);
            break;
          case TSchemaType::NULL_T:
            $builder = new NullBuilder($new_ctx, $suffix, $schema, $class);
            break;
        }
      } else {

        // JSON schema has a shortcut for `anyOf` by defining an array of
        // schemas within `type`. We just leverage our existing `anyOf` builder
        // and convert to that here.

        $types = type_assert_shape(
          $type,
          '\Slack\Hack\JsonSchema\Codegen\TSchemaTypeVec',
        );

        $any_of = vec[];
        foreach ($types as $type) {
          $any_of[] = shape(
            'type' => $type,
          );
        }

        Shapes::removeKey(inout $schema, 'type');
        $schema['anyOf'] = $any_of;
        $builder = new UntypedBuilder($new_ctx, $suffix, $schema, $class);
      }
    } else {
      $builder = new UntypedBuilder($new_ctx, $suffix, $schema, $class);
    }

    $this->builder = $builder;
  }

  public function build(): this {
    $this->builder->build();
    return $this;
  }

  public function getBuilder(): IBuilder {
    return $this->builder;
  }

  public function getType(): string {
    return $this->builder->getType();
  }

  public function getClassName(): string {
    return $this->builder->getClassName();
  }

  public function getUnresolvedSchema(): TSchema {
    return $this->schema;
  }

  public function getResolvedSchema(): TSchema {
    return $this->resolvedSchema;
  }

  public function setSuffix(string $suffix): void {
    $this->builder->setSuffix($suffix);
  }
}
