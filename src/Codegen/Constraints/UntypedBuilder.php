<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\{C, Math, Str, Vec};
use type Facebook\HackCodegen\{CodegenMethod, CodegenType, HackBuilder, HackBuilderKeys, HackBuilderValues};

type TUntypedSchema = shape(
  ?'anyOf' => vec<TSchema>,
  ?'allOf' => vec<TSchema>,
  ?'not' => vec<TSchema>,
  ?'oneOf' => vec<TSchema>,
  ...
);

type TOptimizedAnyOfTypes = shape(
  'key' => string,
  'types' => dict<string, SchemaBuilder>,
);

class UntypedBuilder extends BaseBuilder<TUntypedSchema> {
  protected static string $schema_name = 'Slack\hack\JsonSchema\Codegen\TUntypedSchema';
  private ?string $current_type = null;

  <<__Override>>
  public function build(): this {
    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod());

    $this->addBuilderClass($class);

    $type = $this->codegenType();
    $this->ctx->getFile()->addBeforeType($type);

    return $this;
  }

  protected function getCheckMethod(): CodegenMethod {
    $hb = $this->getHackBuilder();

    $any_of = $this->typed_schema['anyOf'] ?? null;
    if ($any_of is nonnull) {
      $this->generateAnyOfChecks($any_of, $hb);
    }

    $all_of = $this->typed_schema['allOf'] ?? null;
    if ($all_of is nonnull) {
      $this->generateAllOfChecks($all_of, $hb);
    }

    $not = $this->typed_schema['not'] ?? null;
    if ($not is nonnull) {
      $this->generateNotChecks($not, $hb);
    }

    $one_of = $this->typed_schema['oneOf'] ?? null;
    if ($one_of is nonnull) {
      $this->generateOneOfChecks($one_of, $hb);
    }

    $pointer_param = 'string $pointer';
    $has_any_check = vec[$any_of, $all_of, $not, $one_of] |> Vec\filter_nulls($$);
    if (C\is_empty($has_any_check)) {
      // If there are no valid checks, just return $input. We don't throw an
      // error because this could be a "definitions" file that points to valid
      // schemas.
      $hb->addReturn('$input', HackBuilderValues::literal());

      // This will be an unused variable, appease the linter
      $pointer_param = 'string $_pointer';
    }

    return $this->codegenCheckMethod()
      ->addParameters(vec['mixed $input', $pointer_param])
      ->setBody($hb->getCode())
      ->setReturnType($this->getType());
  }

  private function generateNotChecks(vec<TSchema> $schemas, HackBuilder $hb): void {
    $constraints = vec[];
    foreach ($schemas as $index => $schema) {
      $schema_builder = new SchemaBuilder(
        $this->ctx,
        $this->generateClassName($this->suffix, 'not', (string)$index),
        $schema,
      );
      $schema_builder->build();
      $constraints[] = "{$schema_builder->getClassName()}::check<>";
    }

    $hb
      ->addAssignment('$constraints', $constraints, HackBuilderValues::vec(HackBuilderValues::literal()))
      ->ensureEmptyLine();

    $hb
      ->addAssignment('$passed_any', false, HackBuilderValues::export())
      ->addAssignment('$output', null, HackBuilderValues::export())
      ->startForeachLoop('$constraints', null, '$constraint')
      ->startTryBlock()
      ->addMultilineCall('$output = $constraint', vec['$input', '$pointer'])
      ->addAssignment('$passed_any', true, HackBuilderValues::export())
      ->addLine('break;')
      ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
      ->endTryBlock()
      ->endForeachLoop()
      ->ensureEmptyLine();

    $error = shape(
      'code' => 'JsonSchema\FieldErrorCode::FAILED_CONSTRAINT',
      'constraint' => shape(
        'type' => 'JsonSchema\FieldErrorConstraint::NOT',
      ),
      'message' => '\'failed because matched disallowed schema\'',
    );

    $hb
      ->startIfBlock('$passed_any')
      ->addAssignment(
        '$error',
        $error,
        HackBuilderValues::shapeWithPerKeyRendering(shape(
          'code' => HackBuilderValues::literal(),
          'message' => HackBuilderValues::literal(),
          'constraint' => HackBuilderValues::shapeWithUniformRendering(HackBuilderValues::literal()),
        )),
      )
      ->addLine('throw new JsonSchema\\InvalidFieldException($pointer, vec[$error]);')
      ->endIfBlock();

    $hb->addReturn('$output', HackBuilderValues::literal());

  }

  private function generateOneOfChecks(vec<TSchema> $schemas, HackBuilder $hb): void {
    $constraints = vec[];
    foreach ($schemas as $index => $schema) {
      $schema_builder = new SchemaBuilder(
        $this->ctx,
        $this->generateClassName($this->suffix, 'oneOf', (string)$index),
        $schema,
      );
      $schema_builder->build();
      $constraints[] = "{$schema_builder->getClassName()}::check<>";
    }

    $hb
      ->addAssignment('$constraints', $constraints, HackBuilderValues::vec(HackBuilderValues::literal()))
      ->ensureEmptyLine();

    $hb
      ->addAssignment('$passed_any', false, HackBuilderValues::export())
      ->addAssignment('$passed_multi', false, HackBuilderValues::export())
      ->addAssignment('$output', null, HackBuilderValues::export())
      ->startForeachLoop('$constraints', null, '$constraint')
      ->startTryBlock()
      ->addMultilineCall('$output = $constraint', vec['$input', '$pointer'])
      ->startIfBlock('$passed_any')
      ->addAssignment('$passed_multi', true, HackBuilderValues::export())
      ->addLine('break;')
      ->endIfBlock()
      ->addAssignment('$passed_any', true, HackBuilderValues::export())
      ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
      ->endTryBlock()
      ->endForeachLoop()
      ->ensureEmptyLine();

    $error = shape(
      'code' => 'JsonSchema\FieldErrorCode::FAILED_CONSTRAINT',
      'constraint' => shape(
        'type' => 'JsonSchema\FieldErrorConstraint::ONE_OF',
      ),
      'message' => '\'failed to match exactly one allowed schema\'',
    );

    $hb
      ->startIfBlock('$passed_multi || !$passed_any')
      ->addAssignment(
        '$error',
        $error,
        HackBuilderValues::shapeWithPerKeyRendering(shape(
          'code' => HackBuilderValues::literal(),
          'message' => HackBuilderValues::literal(),
          'constraint' => HackBuilderValues::shapeWithUniformRendering(HackBuilderValues::literal()),
        )),
      )
      ->addLine('throw new JsonSchema\\InvalidFieldException($pointer, vec[$error]);')
      ->endIfBlock();

    $hb->addReturn('$output', HackBuilderValues::literal());

  }

  private function generateAllOfChecks(vec<TSchema> $schemas, HackBuilder $hb): void {
    $merged_schema = $this->getMergedAllOfChecks();
    if ($merged_schema) {
      $this->generateMergedAllOfChecks($merged_schema, $hb);
    } else {
      $this->generateMixedAllOfChecks($schemas, $hb);
    }
  }

  /**
   * Attempt to merge schemas in an `allOf` declaration into a single object.
   * Doing so will allow us to generate a Hack shape instead of using `mixed`.
   * If the declarations conflict, or if there's a non `allOf` constraint present,
   * bail out and just used `mixed`.
   */
  public function getMergedAllOfChecks(): ?TSchema {
    // Bail if this schema contains more than an `allOf` constraint.
    if (C\count(Shapes::toDict($this->typed_schema)) !== 1) {
      return null;
    }

    $merged_properties = dict[];
    $merged_required = vec[];
    $max_properties = null;
    $min_properties = null;
    $coerce = false;

    $schemas = $this->typed_schema['allOf'] ?? vec[]
      |> Vec\reverse($$); // Reverse for parity with non-strict output; this shouldn't actually matter.
    foreach ($schemas as $index => $schema) {
      $schema_builder = new SchemaBuilder(
        $this->ctx,
        $this->generateClassName($this->suffix, 'allOf', (string)$index),
        $schema
      );
      $schema = $schema_builder->getResolvedSchema();
      if (Shapes::keyExists($schema, 'allOf')) {
        $builder = new UntypedBuilder($this->ctx, 'allOf', $schema);
        $schema = $builder->getMergedAllOfChecks();
      }

      if (!$schema || Shapes::idx($schema, 'type') !== TSchemaType::OBJECT_T) {
        return null;
      }

      $schema = type_assert_shape<TObjectSchema>($schema, TObjectSchema::class);

      if (Shapes::idx($schema, 'additionalProperties', true)) {
        // If any schema allows arbitrary properties, just bail out to keep this simple.
        return null;
      }

      if (Shapes::idx($schema, 'patternProperties')) {
        // We don't currently support merging pattern properties, though we probably could.
        return null;
      }

      $resolved_context = $schema_builder->getResolvedContext();
      $resolved_root_directory = $resolved_context->getRefsRootDirectory();
      if ($resolved_root_directory is null) {
        $resolved_root_directory = __DIR__;
      } else {
        $resolved_root_directory = \realpath($resolved_root_directory);
      }

      foreach ($schema['properties'] ?? dict[] as $name => $prop) {
        if (C\contains_key($merged_properties, $name)) {
          // TODO: We could more intelligently handle duplicate keys.
          return null;
        }

        if (Shapes::keyExists($prop, '$ref')) {
          $root_directory = $this->ctx->getRefsRootDirectory();
          if ($root_directory is null) {
            $root_directory = __DIR__;
          } else {
            $root_directory = \realpath($root_directory);
          }

          if ($resolved_root_directory !== $root_directory) {
            // Disgusting hack: let's just rewind the entire root directory
            $prop_root = $resolved_root_directory.'/';
            if (Str\starts_with($prop['$ref'], '#')) {
              // Ref in the same file
              $prop_root = $resolved_root_directory.'/'.$resolved_context->getCurrentRefFileName();
            } else {
              // External file containing ref
              $prop_root = $resolved_root_directory.'/';
            }
            $num_root_directory_parts = C\count(Str\split($root_directory, '/'));
            for ($i = 0; $i < $num_root_directory_parts - 1; $i++) {
              $prop_root = '/..'.$prop_root;
            }
            $prop['$ref'] = $prop_root.$prop['$ref'];
          }
        }

        $merged_properties[$name] = $prop;
      }

      $merged_required = ($schema['required'] ?? vec[])
        |> Vec\concat($merged_required, $$)
        |> Vec\unique($$);

      if (Shapes::keyExists($schema, 'minProperties')) {
        $min_properties = $min_properties is null
          ? $schema['minProperties']
          : Math\maxva($min_properties, $schema['minProperties']);
      }

      if (Shapes::keyExists($schema, 'maxProperties')) {
        $max_properties = $max_properties is null
          ? $schema['maxProperties']
          : Math\minva($max_properties, $schema['maxProperties']);
      }

      $coerce = $coerce || Shapes::idx($schema, 'coerce', false);
    }

    if (!$merged_properties) {
      return null;
    }

    $merged_schema = shape(
      'type' => TSchemaType::OBJECT_T,
      'additionalProperties' => false,
      'properties' => $merged_properties,
      'required' => $merged_required,
    );
    if ($min_properties) {
      $merged_schema['min_properties'] = $min_properties;
    }
    if ($max_properties) {
      $merged_schema['max_properties'] = $max_properties;
    }
    if ($coerce) {
      $merged_schema['coerce'] = $coerce;
    }
    return $merged_schema;
  }

  private function generateMergedAllOfChecks(TSchema $schema, HackBuilder $hb): void {
    $schema_builder = new SchemaBuilder(
      $this->ctx,
      $this->generateClassName($this->suffix, 'allOf'),
      $schema
    );
    $schema_builder->build();
    $this->current_type = $schema_builder->getType();
    $hb->addReturnf('%s::check($input, $pointer)', $schema_builder->getClassName());
  }

  private function generateMixedAllOfChecks(vec<TSchema> $schemas, HackBuilder $hb): void {
    $constraints = vec[];
    foreach ($schemas as $index => $schema) {
      $schema_builder = new SchemaBuilder(
        $this->ctx,
        $this->generateClassName($this->suffix, 'allOf', (string)$index),
        $schema,
      );
      $schema_builder->build();
      $constraints[] = "{$schema_builder->getClassName()}::check<>";
    }

    $hb
      ->addAssignment('$constraints', $constraints, HackBuilderValues::vec(HackBuilderValues::literal()))
      ->ensureEmptyLine();

    $hb
      ->addAssignment('$failed_any', false, HackBuilderValues::export())
      ->addAssignment('$errors', vec[], HackBuilderValues::vec(HackBuilderValues::export()))
      ->addAssignment('$output', '$input', HackBuilderValues::literal())
      ->startForeachLoop('$constraints', null, '$constraint')
      ->startTryBlock()
      ->addMultilineCall('$output = $constraint', vec['$output', '$pointer'])
      ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
      ->addAssignment('$errors', '\HH\Lib\Vec\concat($errors, $e->errors)', HackBuilderValues::literal())
      ->addAssignment('$failed_any', true, HackBuilderValues::export())
      ->endTryBlock()
      ->endForeachLoop()
      ->ensureEmptyLine();

    $error = shape(
      'code' => 'JsonSchema\FieldErrorCode::FAILED_CONSTRAINT',
      'constraint' => shape(
        'type' => 'JsonSchema\FieldErrorConstraint::ALL_OF',
      ),
      'message' => '\'failed to match all allowed schemas\'',
    );

    $hb
      ->startIfBlock('$failed_any')
      ->addAssignment(
        '$error',
        $error,
        HackBuilderValues::shapeWithPerKeyRendering(shape(
          'code' => HackBuilderValues::literal(),
          'message' => HackBuilderValues::literal(),
          'constraint' => HackBuilderValues::shapeWithUniformRendering(HackBuilderValues::literal()),
        )),
      )
      ->ensureEmptyLine()
      ->addAssignment('$output_errors', 'vec[$error]', HackBuilderValues::literal())
      ->addAssignment('$output_errors', '\HH\Lib\Vec\concat($output_errors, $errors)', HackBuilderValues::literal())
      ->addLine('throw new JsonSchema\\InvalidFieldException($pointer, $output_errors);')
      ->endIfBlock();

    $hb->addReturn('$output', HackBuilderValues::literal());
  }

  private function generateAnyOfChecks(vec<TSchema> $schemas, HackBuilder $hb): void {
    $schema_builders = Vec\map_with_key(
      $schemas,
      ($index, $schema) ==>
        new SchemaBuilder($this->ctx, $this->generateClassName($this->suffix, 'anyOf', (string)$index), $schema),
    );

    $any_of_types = $this->getOptimizedAnyOfTypes($schema_builders);
    if ($any_of_types is nonnull) {
      $this->generateOptimizedAnyOfChecks($any_of_types, $hb);
    } else {
      $this->generateGenericAnyOfChecks($schema_builders, $hb);
    }
  }

  /**
  * This method inspects all of the schemas defined in the `anyOf` definition
  * to determine if we can optimize the validator. The case we're looking to
  * optimize is when:
  * - the schemas are all objects
  * - all the objects share the same required key
  * - that key is an enum string
  * - each schema only defines a single value for that key
  *
  * For example, if each schema in an `anyOf` array is an object with a "type"
  * key, instead of validating incoming values against all available schemas,
  * we can use the required "type" key to validate against a specific schema.
  */
  private function getOptimizedAnyOfTypes(vec<SchemaBuilder> $schema_builders): ?TOptimizedAnyOfTypes {
    // For any "object" type in the incoming schemas, build up a map of the
    // property name to a map of an enum value to schema builder. The case
    // we're looking for will have a property name that maps to a dict with N
    // number of unique enum keys (where N is the number of incoming schemas --
    // indicating that each incoming schema had the same field and it was an
    // enum).
    $object_to_enum_builder_map = dict[];
    foreach ($schema_builders as $schema_builder) {
      $resolved_schema = $schema_builder->getResolvedSchema();

      $type = $resolved_schema['type'] ?? null;
      if ($type is string) {
        $type = TSchemaType::assert($type);
        if ($type === TSchemaType::OBJECT_T) {
          $typed = type_assert_shape($resolved_schema, 'Slack\Hack\JsonSchema\Codegen\TObjectSchema');
          $required = $typed['required'] ?? vec[];
          $properties = $typed['properties'] ?? null;
          if ($properties is nonnull) {
            foreach ($properties as $property_name => $property_schema) {
              $property_type = $property_schema['type'] ?? null;
              if ($property_type === null) {
                continue;
              }
              $property_type = TSchemaType::assert($property_type);

              if ($property_type === TSchemaType::STRING_T && C\contains($required, $property_name)) {
                $typed_property_schema = type_assert_shape(
                  $property_schema,
                  'Slack\Hack\JsonSchema\Codegen\TStringSchema',
                );

                $enum = $typed_property_schema['enum'] ?? null;
                if ($enum is nonnull && C\count($enum) === 1) {
                  if (!C\contains_key($object_to_enum_builder_map, $property_name)) {
                    $object_to_enum_builder_map[$property_name] = dict[];
                  }

                  $object_to_enum_builder_map[$property_name][$enum[0]] = $schema_builder;
                }
              }
            }
          }
        }
      }
    }

    $optimization = null;
    foreach ($object_to_enum_builder_map as $key => $types) {
      if (C\count($types) === C\count($schema_builders)) {
        $optimization = shape(
          'key' => $key,
          'types' => $types,
        );
        break;
      }
    }

    return $optimization;
  }

  private function generateGenericAnyOfChecks(vec<SchemaBuilder> $schema_builders, HackBuilder $hb): void {
    $constraints = vec[];
    foreach ($schema_builders as $schema_builder) {
      $constraints[] = "{$schema_builder->getClassName()}::check<>";
    }

    // Checks for the special case of one null and one non-null type in order to
    // form a nullable unified type.
    //
    // For unique references, we require that the schemas be built before
    // accessing the type. However, we want to filter out the `NullBuilder` in
    // this special case before it gets built. If we run into this case, we'll
    // store a reference to the `non_null_schema_builder` that we can reference
    // after we've filtered out the `NullBuilder` and have built all the
    // schemas. This lets us adjust the current type to be nullable
    // (`?<whatever>`)
    $non_null_schema_builder = null;
    if (C\count($schema_builders) === 1) {
      $this->current_type = $schema_builders[0]->getType();
    } else if (C\count($schema_builders) === 2) {
      $without_null = Vec\filter($schema_builders, $sb ==> !($sb->getBuilder() is NullBuilder));

      if (C\count($without_null) === 1) {
        $non_null_schema_builder = $without_null[0];

        $constraints = vec["{$non_null_schema_builder->getClassName()}::check<>"];
        $schema_builders = vec[$non_null_schema_builder];

        $hb
          ->startIfBlock('$input === null')
          ->addReturn(null, HackBuilderValues::export())
          ->endIfBlock()
          ->ensureEmptyLine();
      }
    }

    foreach ($schema_builders as $sb) {
      $sb->build();
    }

    if ($non_null_schema_builder is nonnull) {
      $this->current_type = '?'.$non_null_schema_builder->getType();
    }

    $hb
      ->addAssignment('$constraints', $constraints, HackBuilderValues::vec(HackBuilderValues::literal()))
      ->addAssignment('$errors', vec[], HackBuilderValues::vec(HackBuilderValues::export()))
      ->ensureEmptyLine();

    $hb
      ->startForeachLoop('$constraints', null, '$constraint')
      ->startTryBlock()
      ->addMultilineCall('$output = $constraint', vec['$input', '$pointer'])
      ->addReturn('$output', HackBuilderValues::literal())
      ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
      ->addAssignment('$errors', '\HH\Lib\Vec\concat($errors, $e->errors)', HackBuilderValues::literal())
      ->endTryBlock()
      ->endForeachLoop()
      ->ensureEmptyLine();

    $error = shape(
      'code' => 'JsonSchema\FieldErrorCode::FAILED_CONSTRAINT',
      'constraint' => shape(
        'type' => 'JsonSchema\FieldErrorConstraint::ANY_OF',
      ),
      'message' => '\'failed to match any allowed schemas\'',
    );

    $hb
      ->addAssignment(
        '$error',
        $error,
        HackBuilderValues::shapeWithPerKeyRendering(shape(
          'code' => HackBuilderValues::literal(),
          'message' => HackBuilderValues::literal(),
          'constraint' => HackBuilderValues::shapeWithUniformRendering(HackBuilderValues::literal()),
        )),
      )
      ->ensureEmptyLine()
      ->addAssignment('$output_errors', 'vec[$error]', HackBuilderValues::literal())
      ->addAssignment('$output_errors', '\HH\Lib\Vec\concat($output_errors, $errors)', HackBuilderValues::literal())
      ->addLine('throw new JsonSchema\\InvalidFieldException($pointer, $output_errors);');
  }

  private function generateOptimizedAnyOfChecks(TOptimizedAnyOfTypes $any_of_types, HackBuilder $hb): void {
    $types = dict[];
    foreach ($any_of_types['types'] as $type_name => $schema_builder) {
      $suffix = $this->generateClassName($this->suffix, 'anyOfTypes', $type_name);
      $schema_builder->setSuffix($suffix);
      $schema_builder->build();

      $types[$type_name] = "{$schema_builder->getClassName()}::check<>";
    }

    $hb
      ->addAssignment('$key', $any_of_types['key'], HackBuilderValues::export())
      ->addAssignment(
        '$typed',
        'Constraints\ObjectConstraint::check($input, $pointer, false)',
        HackBuilderValues::literal(),
      )
      ->ensureEmptyLine()
      ->addMultilineCall('Constraints\ObjectRequiredConstraint::check', vec['$typed', 'keyset[$key]', '$pointer'])
      ->addAssignment('$field_pointer', 'JsonSchema\get_pointer($pointer, $key)', HackBuilderValues::literal())
      ->addAssignment(
        '$type_name',
        'Constraints\StringConstraint::check($typed[$key] ?? null, $field_pointer, false)',
        HackBuilderValues::literal(),
      )
      ->ensureEmptyLine()
      ->addAssignment(
        '$types',
        $types,
        HackBuilderValues::dict(HackBuilderKeys::export(), HackBuilderValues::literal()),
      )
      ->ensureEmptyLine();

    $hb
      ->addAssignment('$constraint', '$types[$type_name] ?? null', HackBuilderValues::literal());

    $error = shape(
      'code' => 'JsonSchema\FieldErrorCode::FAILED_CONSTRAINT',
      'constraint' => shape(
        'type' => 'JsonSchema\FieldErrorConstraint::ENUM',
        'expected' => '\HH\Lib\Vec\keys($types)',
        'got' => '$type_name',
      ),
      'message' => '"unsupported type: {$type_name}"',
    );

    $hb
      ->startIfBlock('$constraint === null')
      ->addAssignment(
        '$error',
        $error,
        HackBuilderValues::shapeWithPerKeyRendering(shape(
          'code' => HackBuilderValues::literal(),
          'message' => HackBuilderValues::literal(),
          'constraint' => HackBuilderValues::shapeWithUniformRendering(HackBuilderValues::literal()),
        )),
      )
      ->addLine('throw new JsonSchema\\InvalidFieldException($field_pointer, vec[$error]);')
      ->endIfBlock()
      ->ensureEmptyLine();

    $hb
      ->addMultilineCall('return $constraint', vec['$typed', '$pointer']);
  }

  <<__Override>>
  public function getType(): string {
    return $this->generateTypeName($this->getClassName());
  }

  private function codegenType(): CodegenType {
    return $this->ctx
      ->getHackCodegenFactory()
      ->codegenType($this->getType())
      ->setType($this->current_type ?? 'mixed');
  }

}
