<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use type Facebook\HackCodegen\{
  CodegenFile,
  CodegenFileType,
  CodegenGeneratedFrom,
  CodegenMethod,
  HackBuilder,
  HackCodegenFactory,
  IHackCodegenConfig,
};

use namespace HH\Lib\Str;

final class ValidatorBuilder {
  private ?CodegenGeneratedFrom $generatedFrom;
  private HackCodegenFactory $cg;
  private bool $discardChanges = false;
  private bool $createAbstract = false;
  private ?Codegen::TSanitizeStringConfig $sanitizeString = null;

  public function __construct(
    private Codegen::TCodegenConfig $codegenConfig,
    private IHackCodegenConfig $hackCodegenConfig,
    private IJsonSchemaCodegenConfig $jsonSchemaCodegenConfig,
    private dict<arraykey, mixed> $schema,
  ) {
    $this->cg = new HackCodegenFactory($hackCodegenConfig);
  }

  public function setCreateAbstractClass(bool $abstract): this {
    $this->createAbstract = $abstract;
    return $this;
  }

  public function setGeneratedFrom(CodegenGeneratedFrom $generated_from): this {
    $this->generatedFrom = $generated_from;
    return $this;
  }

  public function setDiscardChanges(bool $discard): this {
    $this->discardChanges = $discard;
    return $this;
  }

  public function setSanitizeString(?Codegen::TSanitizeStringConfig $sanitize_string): this {
    $this->sanitizeString = $sanitize_string;
    return $this;
  }

  public function renderToFile(string $filename, ?string $namespace, string $classname): CodegenFile {
    $file = $this->getCodegenFile($filename, $namespace, $classname);
    $file->save();
    return $file;
  }

  private function getCodegenFile(string $filename, ?string $namespace, string $classname): CodegenFile {
    $file = $this->cg
      ->codegenFile($filename)
      ->setDoClobber($this->discardChanges)
      ->setFileType(CodegenFileType::HACK_STRICT)
      ->setGeneratedFrom($this->generatedFrom ?? $this->cg->codegenGeneratedFromScript())
      ->useNamespace('Slack\Hack\JsonSchema');

    $this->buildCodegenClass($classname, $file);

    if ($namespace !== null) {
      $file->setNamespace($namespace);
    }

    return $file;
  }

  private function buildCodegenClass(string $classname, CodegenFile $file): void {
    $class = $this->cg->codegenClass($classname);

    $root = new RootBuilder(
      $this->codegenConfig,
      $this->cg,
      $this->jsonSchemaCodegenConfig,
      $this->schema,
      $class,
      $file,
    );

    $root->build();

    $abstract = $this->createAbstract;
    $class
      ->setExtends("JsonSchema\BaseValidator<{$root->getType()}>")
      ->setIsAbstract($abstract)
      ->setIsFinal(!$abstract)
      ->addMethod($this->getCodegenClassProcessMethod($root));

    $file->addClass($class);

    $contents = $file->render();
    if (Str\contains($contents, 'Constraints\\')) {
      $file->useNamespace('Slack\Hack\JsonSchema\Constraints');
    }
  }

  private function getCodegenClassProcessMethod(RootBuilder $root): CodegenMethod {
    $hb = new HackBuilder($this->hackCodegenConfig);
    $hb->addMultilineCall('return self::check', vec['$this->input', '$this->pointer']);

    return $this->cg
      ->codegenMethod('process')
      ->setReturnType($root->getType())
      ->addEmptyUserAttribute('__Override')
      ->setProtected()
      ->setBody($hb->getCode());
  }

}
