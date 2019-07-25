<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use type Facebook\HackCodegen\{
  CodegenMethod,
  HackBuilderValues,
};

type TStringSchema = shape(
  'type' => TSchemaType,
  ?'maxLength' => int,
  ?'minLength' => int,
  ?'enum' => vec<string>,
  ?'pattern' => string,
  ?'format' => string,
  ?'sanitize' => shape(
    'multiline' => bool,
  ),
  ?'coerce' => bool,
  ...
);

class StringBuilder extends BaseBuilder<TStringSchema> {
  protected static string $schema_name =
    'Slack\Hack\JsonSchema\Codegen\TStringSchema';

  <<__Override>>
  public function build(): this {
    $class = $this->codegenClass()
      ->addMethod($this->getCheckMethod());

    $properties = [];
    $max_length = $this->typed_schema['maxLength'] ?? null;
    if ($max_length is nonnull) {
      $properties[] = $this->codegenProperty('maxLength')
        ->setType('int')
        ->setValue($max_length, HackBuilderValues::export());
    }

    $min_length = $this->typed_schema['minLength'] ?? null;
    if ($min_length is nonnull) {
      $properties[] = $this->codegenProperty('minLength')
        ->setType('int')
        ->setValue($min_length, HackBuilderValues::export());
    }

    $pattern = $this->typed_schema['pattern'] ?? null;
    if ($pattern is nonnull) {
      $properties[] = $this->codegenProperty('pattern')
        ->setType('string')
        ->setValue($pattern, HackBuilderValues::export());
    }

    $format = $this->typed_schema['format'] ?? null;
    if ($format is nonnull) {
      $properties[] = $this->codegenProperty('format')
        ->setType('string')
        ->setValue($format, HackBuilderValues::export());
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
    $hb = $this->getHackBuilder()
      ->addAssignment(
        '$typed',
        'Constraints\StringConstraint::check($input, $pointer, self::$coerce)',
        HackBuilderValues::literal(),
      )
      ->ensureEmptyLine();

    $sanitize = $this->typed_schema['sanitize'] ?? null;
    $sanitize_string = $this->ctx->getSanitizeStringConfig();
    if ($sanitize is nonnull && $sanitize_string === null) {
      throw new \Exception(
        "Specified `sanitize` on a string without providing sanitization functions.",
      );
    } else if ($sanitize is nonnull && $sanitize_string is nonnull) {
      if ($sanitize['multiline']) {
        $sanitization_func = (string)$sanitize_string['multiline'];
      } else {
        $sanitization_func = (string)$sanitize_string['uniline'];
      }

      $hb
        ->addAssignment(
          '$sanitize_string',
          "fun('\\$sanitization_func')",
          HackBuilderValues::literal(),
        )
        ->addAssignment(
          '$typed',
          '$sanitize_string($typed)',
          HackBuilderValues::literal(),
        )
        ->ensureEmptyLine();
    }

    $this->addEnumConstraintCheck($hb);

    $max_length = $this->typed_schema['maxLength'] ?? null;
    $min_length = $this->typed_schema['minLength'] ?? null;
    $pattern = $this->typed_schema['pattern'] ?? null;
    $format = $this->typed_schema['format'] ?? null;

    if ($pattern is nonnull) {
      $hb->addMultilineCall(
        'Constraints\StringPatternConstraint::check',
        ['$typed', 'self::$pattern', '$pointer'],
      );
    }

    if ($format is nonnull) {
      $hb->addMultilineCall(
        'Constraints\StringFormatConstraint::check',
        ['$typed', 'self::$format', '$pointer'],
      );
    }

    if ($max_length is nonnull || $min_length is nonnull) {
      $hb->addAssignment(
        '$length',
        '\mb_strlen($typed)',
        HackBuilderValues::literal(),
      );
    }

    if ($max_length is nonnull) {
      $hb->addMultilineCall(
        'Constraints\StringMaxLengthConstraint::check',
        ['$length', 'self::$maxLength', '$pointer'],
      );
    }

    if ($min_length is nonnull) {
      $hb->addMultilineCall(
        'Constraints\StringMinLengthConstraint::check',
        ['$length', 'self::$minLength', '$pointer'],
      );
    }

    $hb->addReturn('$typed', HackBuilderValues::literal());

    return $this->codegenCheckMethod()
      ->addParameters(['mixed $input', 'string $pointer'])
      ->setBody($hb->getCode())
      ->setReturnType('string');
  }

  <<__Override>>
  public function getType(): string {
    return 'string';
  }
}
