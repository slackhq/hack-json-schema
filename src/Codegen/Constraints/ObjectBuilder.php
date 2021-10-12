<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\{C, Keyset, Str};

use type Facebook\HackCodegen\{
  CodegenMethod,
  CodegenShapeMember,
  CodegenType,
  HackBuilder,
  HackBuilderKeys,
  HackBuilderValues,
};

type TObjectSchema = shape(
  'type' => TSchemaType,
  ?'required' => vec<string>,
  ?'properties' => dict<string, TSchema>,
  ?'additionalProperties' => mixed,
  ?'patternProperties' => dict<string, TSchema>,
  ?'coerce' => bool,
  ?'minProperties' => int,
  ?'maxProperties' => int,
  ...
);

class ObjectBuilder extends BaseBuilder<TObjectSchema> {
  protected static string $schema_name = 'Slack\Hack\JsonSchema\Codegen\TObjectSchema';

  <<__Override>>
  public function build(): this {
    // Each property is itself a JSON schema. We need to build the classes for
    // each of those schemas first, since we'll use those generated classes in
    // this class's check method.
    $properties = $this->typed_schema['properties'] ?? null;
    $property_classes = null;
    if ($properties is nonnull) {
      $property_classes = $this->buildClassesForProperties($properties);
    }

    $pattern_properties = $this->typed_schema['patternProperties'] ?? null;
    $pattern_properties_classes = null;
    if ($pattern_properties is nonnull) {
      $pattern_properties_classes = $this->buildClassesForPatternProperties($pattern_properties);
    }

    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod($property_classes, $pattern_properties_classes));

    $class_properties = vec[];
    $required = $this->typed_schema['required'] ?? null;
    if ($required is nonnull) {
      $hb = $this->getHackBuilder()
        ->addValue(keyset($required), HackBuilderValues::keyset(HackBuilderValues::export()));

      $class_properties[] = $this->codegenProperty('required')
        ->setType('keyset<string>')
        ->setValue($hb->getCode(), HackBuilderValues::literal());
    }

    $coerce = $this->typed_schema['coerce'] ?? $this->ctx->getCoerceDefault();
    $class_properties[] = $this->codegenProperty('coerce')
      ->setType('bool')
      ->setValue($coerce, HackBuilderValues::export());

    $additional_properties = $this->typed_schema['additionalProperties'] ?? null;

    if (($additional_properties is nonnull || $pattern_properties is nonnull) && $properties is nonnull) {
      $properties = $this->typed_schema['properties'] ?? dict[];
      $hb = $this->getHackBuilder()
        ->addValue(Keyset\keys($properties), HackBuilderValues::keyset(HackBuilderValues::export()));

      $class_properties[] = $this->codegenProperty('properties')
        ->setType('keyset<string>')
        ->setValue($hb->getCode(), HackBuilderValues::literal());
    }

    $max_properties = $this->typed_schema['maxProperties'] ?? null;
    if ($max_properties is nonnull) {
      if ($max_properties < 0) {
        throw new \Exception('maxProperties must be a non-negative integer');
      }

      $class_properties[] = $this->codegenProperty('maxProperties')
        ->setType('int')
        ->setValue($max_properties, HackBuilderValues::export());
    }

    $min_properties = $this->typed_schema['minProperties'] ?? null;
    if ($min_properties is nonnull) {
      if ($min_properties < 0) {
        throw new \Exception('minProperties must be a non-negative integer');
      }

      $class_properties[] = $this->codegenProperty('minProperties')
        ->setType('int')
        ->setValue($min_properties, HackBuilderValues::export());
    }

    if ($min_properties is nonnull && $max_properties is nonnull) {
      if ($min_properties > $max_properties) {
        throw new \Exception('maxProperties must be greater than minProperties');
      }
    }

    $class->addProperties($class_properties);
    $this->addBuilderClass($class);

    // Generate a type based on the specified properties
    $type = $this->codegenType($property_classes, $pattern_properties_classes);
    $this->ctx->getFile()->addBeforeType($type);
    return $this;
  }

  <<__Override>>
  public function getType(): string {
    return $this->generateTypeName($this->getClassName());
  }

  protected function getCheckMethod(
    ?dict<string, SchemaBuilder> $properties,
    ?dict<string, SchemaBuilder> $pattern_properties,
  ): CodegenMethod {
    $hb = $this->getCheckMethodCode($properties, $pattern_properties);

    return $this->codegenCheckMethod()
      ->addParameters(vec['mixed $input', 'string $pointer'])
      ->setBody($hb->getCode())
      ->setReturnType($this->getType());
  }

  protected function getCheckMethodCode(
    ?dict<string, SchemaBuilder> $properties,
    ?dict<string, SchemaBuilder> $pattern_properties,
  ): HackBuilder {
    $hb = $this->getHackBuilder();

    $additional_properties = $this->typed_schema['additionalProperties'] ?? null;
    $is_additional_properties_boolean = $additional_properties is nonnull && $additional_properties is bool;
    $allow_any_additional_properties = $additional_properties is nonnull &&
      $is_additional_properties_boolean &&
      $additional_properties;

    $hb
      ->addAssignment(
        '$typed',
        'Constraints\ObjectConstraint::check($input, $pointer, self::$coerce)',
        HackBuilderValues::literal(),
      );

    # Check for the simplest case where we just want to return the resulting dictionary
    if ($properties === null && $pattern_properties === null && $allow_any_additional_properties) {
      $hb->addReturn('$typed', HackBuilderValues::literal());
      return $hb;
    }

    $include_error_handling = false;
    if ($properties is nonnull || $pattern_properties is nonnull) {
      $include_error_handling = true;
    } else if ($additional_properties is nonnull && (!$is_additional_properties_boolean || !$additional_properties)) {
      $include_error_handling = true;
    }

    $max_properties = $this->typed_schema['maxProperties'] ?? null;
    $min_properties = $this->typed_schema['minProperties'] ?? null;

    if ($max_properties is nonnull || $min_properties is nonnull) {
      $hb->addAssignment('$length', '\HH\Lib\C\count($typed)', HackBuilderValues::literal())->ensureEmptyLine();
    }

    if ($max_properties is nonnull) {
      $hb->addMultilineCall(
        'Constraints\ObjectMaxPropertiesConstraint::check',
        vec['$length', 'self::$maxProperties', '$pointer'],
      )
        ->ensureEmptyLine();
    }

    if ($min_properties is nonnull) {
      $hb->addMultilineCall(
        'Constraints\ObjectMinPropertiesConstraint::check',
        vec['$length', 'self::$minProperties', '$pointer'],
      )
        ->ensureEmptyLine();
    }

    $defaults = $this->getDefaults();
    if (!C\is_empty($defaults)) {
      $hb->ensureEmptyLine();
      $hb->addAssignment(
        '$defaults',
        $defaults,
        HackBuilderValues::dict(HackBuilderKeys::export(), HackBuilderValues::export()),
      );

      # Merge in `$defaults` first so values from `$typed` will override any
      # defaults.
      $hb->addAssignment('$typed', '\HH\Lib\Dict\merge($defaults, $typed)', HackBuilderValues::literal());
      $hb->ensureEmptyLine();
    }

    $required = $this->typed_schema['required'] ?? null;
    if ($required is nonnull) {
      $hb->addMultilineCall(
        'Constraints\ObjectRequiredConstraint::check',
        vec['$typed', 'self::$required', '$pointer'],
      );
    }

    $hb->ensureEmptyLine();

    if ($include_error_handling) {
      $hb->addAssignment('$errors', 'vec[]', HackBuilderValues::literal());
    }

    if ($properties is nonnull) {
      $hb
        ->addAssignment('$output', 'shape()', HackBuilderValues::literal())
        ->ensureEmptyLine();

      if ($additional_properties === null || $allow_any_additional_properties) {
        // If the object allows additional properties, we want to preserve the
        // values within the `input` while still outputting the correct shape
        // based on the schema. There are a couple ways we can do this, one is the
        // option we've gone with, which is intentionally ignoring the type
        // checker warning us about dynamically accessing keys within a shape. The
        // other is to treat `output` as a `dict` until we want to return the
        // value and then use the typeassert library to cast it to the correct
        // type. Using typeassert is going to be a performance hit that we're
        // trying to avoid for the time being. As hhvm features like `as` become
        // more advanced, they'll be an option for handling this in a more
        // performant way in the future. Right now those don't work consistently
        // because they don't work for shapes that contain generics.
        $hb->addLine(
          '/*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/',
        )
          ->startForeachLoop('$typed', '$key', '$value')
          ->addLine(
            '/* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */',
          )
          ->addAssignment('$output[$key]', '$value', HackBuilderValues::literal())
          ->endForeachLoop()
          ->ensureEmptyLine();
      }

      foreach ($properties as $property_name => $property_class) {
        $property_class_name = $property_class->getClassName();
        $required_property = $required is nonnull ? \HH\Lib\C\contains_key($required, $property_name) : false;

        if (!$required_property) {
          $hb->startIfBlockf('\HH\Lib\C\contains_key($typed, \'%s\')', $property_name);
        }

        $hb
          ->startTryBlock()
          ->addMultilineCall(
            "\$output['{$property_name}'] = {$property_class_name}::check",
            vec[
              "\$typed['{$property_name}']",
              "JsonSchema\get_pointer(\$pointer, '{$property_name}')",
            ],
          )
          ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
          ->addLine('$errors = \HH\Lib\Vec\concat($errors, $e->errors);')
          ->endTryBlock();

        if (!$required_property) {
          $hb
            ->endIfBlock();
        }

        $hb->ensureEmptyLine();
      }
    } else {
      # if `properties` isn't defined, we have a dynamic-ish output (either
      # `additionalProperties` or `patternProperties`)
      $hb->addLine(
        '/*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/',
      )
        ->addAssignment('$output', 'dict[]', HackBuilderValues::literal())
        ->ensureEmptyLine();
    }

    if ($pattern_properties is nonnull) {
      $pattern_constraints = dict[];
      foreach ($pattern_properties as $pattern => $schema_builder) {
        $pattern_constraints[$pattern] = "{$schema_builder->getClassName()}::check<>";
      }

      $hb
        ->addAssignment(
          '$patterns',
          $pattern_constraints,
          HackBuilderValues::dict(HackBuilderKeys::export(), HackBuilderValues::literal()),
        )
        ->ensureEmptyLine();
    }

    #
    # Handle `additionalProperties`. `additionalProperties` is either a boolean
    # or a JSON schema.
    #
    # If it is a boolean set to `true`, we don't run additional properties
    # through any validation and simply store them directly in the output.
    #
    # If it is a boolean set to `false`, any property not specified in the
    # object's `properties` key will result in an error.
    #
    # If it is a JSON schema, any property not specified in the object's
    # `properties` key will be run through that JSON schema. These values will
    # also be included in the output and will be typed to the specific schema.
    #

    if (($additional_properties is nonnull && !$allow_any_additional_properties) || $pattern_properties is nonnull) {
      $hb
        ->addLine(
          '/*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/',
        )
        ->startForeachLoop('$typed', '$key', '$value');

      if ($properties is nonnull) {
        $hb
          ->startIfBlock('\HH\Lib\C\contains_key(self::$properties, $key)')
          ->addLine('continue;')
          ->endIfBlock()
          ->ensureEmptyLine();
      }

      if ($pattern_properties is nonnull) {
        $hb
          ->addAssignment('$passed_any', false, HackBuilderValues::export())
          ->addAssignment('$failed_any', false, HackBuilderValues::export())
          ->ensureEmptyLine()
          ->startForeachLoop('$patterns', '$pattern', '$constraint')
          ->startIfBlock('\preg_match("/{$pattern}/", $key)')
          ->startTryBlock();

        if ($properties is nonnull) {
          $hb->addMultilineCall('$constraint', vec['$value', 'JsonSchema\get_pointer($pointer, $key)']);
        } else {
          $hb->addMultilineCall('$output[$key] = $constraint', vec['$value', 'JsonSchema\get_pointer($pointer, $key)']);
        }

        $hb
          ->startIfBlock('!$passed_any')
          ->addAssignment('$passed_any', true, HackBuilderValues::export())
          ->endIfBlock();

        $hb
          ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
          ->addLine('$errors = \HH\Lib\Vec\concat($errors, $e->errors);')
          ->startIfBlock('!$failed_any')
          ->addAssignment('$failed_any', true, HackBuilderValues::export())
          ->endIfBlock()
          ->endTryBlock()
          ->endIfBlock()
          ->endForeachLoop()
          ->ensureEmptyLine();

        $hb
          ->startIfBlock('$passed_any || $failed_any')
          ->addLine('continue;')
          ->endIfBlock()
          ->ensureEmptyLine();
      }

      if ($additional_properties is nonnull && !$additional_properties) {
        $error = shape(
          'code' => 'JsonSchema\FieldErrorCode::FAILED_CONSTRAINT',
          'message' => '"invalid additional property: {$key}"',
          'constraint' => shape(
            'type' => 'JsonSchema\FieldErrorConstraint::ADDITIONAL_PROPERTIES',
            'got' => '$key',
          ),
        );

        $hb
          ->addAssignment(
            '$errors[]',
            $error,
            HackBuilderValues::shapeWithPerKeyRendering(shape(
              'code' => HackBuilderValues::literal(),
              'message' => HackBuilderValues::literal(),
              'constraint' => HackBuilderValues::shapeWithUniformRendering(HackBuilderValues::literal()),
            )),
          );
      } else if ($additional_properties is nonnull) {
        $schema = type_assert_shape($additional_properties, 'Slack\Hack\JsonSchema\Codegen\TSchema');

        $additional_properties_builder = new SchemaBuilder(
          $this->ctx,
          $this->generateClassName($this->suffix, 'additional_properties'),
          $schema,
        );
        $additional_properties_builder->build();
        $additional_properties_class_name = $additional_properties_builder->getClassName();

        $hb
          ->startTryBlock();

        if ($properties is nonnull) {
          # If we've defined `properties` then we'll run checks against
          # `additionalProperties` but we won't output them since we can't
          # output dynamic keys in a shape.
          $hb
            ->addMultilineCall(
              "{$additional_properties_class_name}::check",
              vec['$value', 'JsonSchema\get_pointer($pointer, $key)'],
            );
        } else {
          $hb
            ->addMultilineCall(
              "\$output[\$key] = {$additional_properties_class_name}::check",
              vec['$value', 'JsonSchema\get_pointer($pointer, $key)'],
            );
        }

        $hb
          ->addCatchBlock('JsonSchema\InvalidFieldException', '$e')
          ->addLine('$errors = \HH\Lib\Vec\concat($errors, $e->errors);')
          ->endTryBlock();
      }

      $hb
        ->endIfBlock()
        ->ensureEmptyLine();
    }

    if ($include_error_handling) {
      $hb
        ->startIfBlock('\HH\Lib\C\count($errors)')
        ->addLine('throw new JsonSchema\InvalidFieldException($pointer, $errors);')
        ->endIfBlock()
        ->ensureEmptyLine();
    }

    if ($properties is nonnull) {
      $hb
        ->addLine('/* HH_IGNORE_ERROR[4163] */')
        ->addReturn('$output', HackBuilderValues::literal());
    } else if ($additional_properties is nonnull || $pattern_properties is nonnull) {
      $hb->addReturn('$output', HackBuilderValues::literal());
    } else {
      $hb->addReturn('$typed', HackBuilderValues::literal());
    }

    return $hb;
  }

  <<__Memoize>>
  private function getDefaults(): dict<string, mixed> {
    $properties = $this->typed_schema['properties'] ?? null;
    $defaults = dict[];

    if ($properties === null) {
      return $defaults;
    }

    foreach ($properties as $name => $schema) {
      $default = $schema['default'] ?? null;
      if ($default is nonnull) {
        $defaults[$name] = $default;
      }
    }

    return $defaults;
  }

  private function buildClassesForProperties(dict<string, TSchema> $properties): dict<string, SchemaBuilder> {
    $output = dict[];
    foreach ($properties as $property_name => $property_schema) {
      $suffix = $this->generateClassName($this->suffix, 'properties', $property_name);

      $property_builder = new SchemaBuilder($this->ctx, $suffix, $property_schema);
      $property_builder->build();

      $output[$property_name] = $property_builder;
    }

    return $output;
  }

  private function buildClassesForPatternProperties(dict<string, TSchema> $properties): dict<string, SchemaBuilder> {
    $output = dict[];
    $index = 0;
    foreach ($properties as $pattern => $property_schema) {
      $suffix = $this->generateClassName($this->suffix, 'patternProperties', (string)$index);

      $property_builder = new SchemaBuilder($this->ctx, $suffix, $property_schema);
      $property_builder->build();

      $output[$pattern] = $property_builder;
      $index++;
    }

    return $output;
  }

  private function codegenType(
    ?dict<string, SchemaBuilder> $property_classes = null,
    ?dict<string, SchemaBuilder> $pattern_property_classes = null,
  ): CodegenType {
    if ($property_classes is nonnull) {
      $required = $this->typed_schema['required'] ?? vec[];
      $additional_properties = $this->typed_schema['additionalProperties'] ?? null;
      $defaults = $this->getDefaults();

      $allow_subtyping = $additional_properties is nonnull && $additional_properties is bool
        ? $additional_properties
        : true;

      $members = vec[];
      foreach ($property_classes as $property => $builder) {
        $member = new CodegenShapeMember($property, $builder->getType());
        if (!C\contains($required, $property) && !C\contains_key($defaults, $property)) {
          $member->setIsOptional();
        }

        $members[] = $member;
      }

      $shape = $this->ctx
        ->getHackCodegenFactory()
        ->codegenShape(...$members)
        ->setAllowsSubtyping($allow_subtyping);
      return $this->ctx
        ->getHackCodegenFactory()
        ->codegenType($this->getType())
        ->setShape($shape);
    } else if ($pattern_property_classes is nonnull && C\count($pattern_property_classes) === 1) {
      $builder = vec($pattern_property_classes)[0];
      return $this->ctx
        ->getHackCodegenFactory()
        ->codegenType($this->getType())
        ->setType(Str\format('dict<string, %s>', $builder->getType()));
    } else {
      return $this->ctx
        ->getHackCodegenFactory()
        ->codegenType($this->getType())
        ->setType('dict<string, mixed>');
    }
  }

}
