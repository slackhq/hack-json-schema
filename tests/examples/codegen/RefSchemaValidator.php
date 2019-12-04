<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<fb72babda3f965134cf44f7e186abc8f>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TRefSchemaValidatorPropertiesNullableUniqueRef = ?TExternalExamplesRefSchemaDefinitionsObject;

type TRefSchemaValidatorPropertiesDuplicateRefs = shape(
  ?'first' => TExternalExamplesRefSchemaDefinitionsObject,
  ?'second' => TExternalExamplesRefSchemaDefinitionsObject,
  ?'third' => TExternalExamplesRefSchemaDefinitionsObject,
  ?'fourth' => TExternalExamplesRefSchemaDefinitionsObject,
  ?'fifth' => TExternalExamplesRefSchemaDefinitionsObject,
  ...
);

type TRefSchemaValidator = shape(
  ?'local-reference' => TExamplesRefSchemaDefinitionsLocalObjectReference,
  ?'remote-reference' => string,
  ?'remote-reference-self' => string,
  ?'remote-same-dir-reference' => string,
  ?'remote-nested-dir-reference' => string,
  ?'nullable-unique-ref' => TRefSchemaValidatorPropertiesNullableUniqueRef,
  ?'duplicate-refs' => TRefSchemaValidatorPropertiesDuplicateRefs,
  ?'single-item-array-ref' => vec<TExternalExamplesRefSchemaDefinitionsObject>,
  ...
);

final class RefSchemaValidatorPropertiesNullableUniqueRef {

  public static function check(
    mixed $input,
    string $pointer,
  ): TRefSchemaValidatorPropertiesNullableUniqueRef {
    if ($input === null) {
      return null;
    }

    $constraints = vec[
      class_meth(ExternalExamplesRefSchemaDefinitionsObject::class, 'check'),
    ];
    $errors = vec[
    ];

    foreach ($constraints as $constraint) {
      try {
        $output = $constraint($input, $pointer);
        return $output;
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    $error = shape(
      'code' => JsonSchema\FieldErrorCode::FAILED_CONSTRAINT,
      'constraint' => shape(
        'type' => JsonSchema\FieldErrorConstraint::ANY_OF,
      ),
      'message' => "failed to match any allowed schemas",
    );

    $output_errors = vec[$error];
    $output_errors = \HH\Lib\Vec\concat($output_errors, $errors);
    throw new JsonSchema\InvalidFieldException($pointer, $output_errors);
  }
}

final class RefSchemaValidatorPropertiesDuplicateRefs {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TRefSchemaValidatorPropertiesDuplicateRefs {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'first')) {
      try {
        $output['first'] = ExternalExamplesRefSchemaDefinitionsObject::check(
          $typed['first'],
          JsonSchema\get_pointer($pointer, 'first'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'second')) {
      try {
        $output['second'] = ExternalExamplesRefSchemaDefinitionsObject::check(
          $typed['second'],
          JsonSchema\get_pointer($pointer, 'second'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'third')) {
      try {
        $output['third'] = ExternalExamplesRefSchemaDefinitionsObject::check(
          $typed['third'],
          JsonSchema\get_pointer($pointer, 'third'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'fourth')) {
      try {
        $output['fourth'] = ExternalExamplesRefSchemaDefinitionsObject::check(
          $typed['fourth'],
          JsonSchema\get_pointer($pointer, 'fourth'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'fifth')) {
      try {
        $output['fifth'] = ExternalExamplesRefSchemaDefinitionsObject::check(
          $typed['fifth'],
          JsonSchema\get_pointer($pointer, 'fifth'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }
}

final class RefSchemaValidatorPropertiesSingleItemArrayRef {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TExternalExamplesRefSchemaDefinitionsObject> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = ExternalExamplesRefSchemaDefinitionsObject::check(
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
}

final class RefSchemaValidator
  extends JsonSchema\BaseValidator<TRefSchemaValidator> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TRefSchemaValidator {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'local-reference')) {
      try {
        $output['local-reference'] = ExamplesRefSchemaDefinitionsLocalObjectReference::check(
          $typed['local-reference'],
          JsonSchema\get_pointer($pointer, 'local-reference'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'remote-reference')) {
      try {
        $output['remote-reference'] = ExternalExamplesRefSchemaDefinitionsString::check(
          $typed['remote-reference'],
          JsonSchema\get_pointer($pointer, 'remote-reference'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'remote-reference-self')) {
      try {
        $output['remote-reference-self'] = ExternalExamplesRefSchemaDefinitionsString::check(
          $typed['remote-reference-self'],
          JsonSchema\get_pointer($pointer, 'remote-reference-self'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'remote-same-dir-reference')) {
      try {
        $output['remote-same-dir-reference'] = ExamplesStringSchemaDefinitionsCoerce::check(
          $typed['remote-same-dir-reference'],
          JsonSchema\get_pointer($pointer, 'remote-same-dir-reference'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'remote-nested-dir-reference')) {
      try {
        $output['remote-nested-dir-reference'] = ExamplesNestedNestedDefinitionsDefinitionsString::check(
          $typed['remote-nested-dir-reference'],
          JsonSchema\get_pointer($pointer, 'remote-nested-dir-reference'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'nullable-unique-ref')) {
      try {
        $output['nullable-unique-ref'] = RefSchemaValidatorPropertiesNullableUniqueRef::check(
          $typed['nullable-unique-ref'],
          JsonSchema\get_pointer($pointer, 'nullable-unique-ref'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'duplicate-refs')) {
      try {
        $output['duplicate-refs'] = RefSchemaValidatorPropertiesDuplicateRefs::check(
          $typed['duplicate-refs'],
          JsonSchema\get_pointer($pointer, 'duplicate-refs'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'single-item-array-ref')) {
      try {
        $output['single-item-array-ref'] = RefSchemaValidatorPropertiesSingleItemArrayRef::check(
          $typed['single-item-array-ref'],
          JsonSchema\get_pointer($pointer, 'single-item-array-ref'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }

  <<__Override>>
  final protected function process(): TRefSchemaValidator {
    return self::check($this->input, $this->pointer);
  }
}
