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
  private RootBuilder $builder;
  private ?Codegen::TSanitizeStringConfig $sanitizeString = null;

  public function __construct(
    private Codegen::TCodegenConfig $codegenConfig,
    private IHackCodegenConfig $hackCodegenConfig,
    private IJsonSchemaCodegenConfig $jsonSchemaCodegenConfig,
    private dict<arraykey, mixed> $schema,
  ) {
    $this->cg = new HackCodegenFactory($hackCodegenConfig);

    $config = $codegenConfig['validator'];

    $class = $this->cg->codegenClass($config['class']);

    $file = $this->cg
      ->codegenFile($config['file'])
      ->setFileType(CodegenFileType::HACK_STRICT)
      ->useNamespace('Slack\Hack\JsonSchema');

    if (Shapes::keyExists($config, 'namespace')) {
      $file->setNamespace($config['namespace']);
    }

    $this->builder =
      new RootBuilder($this->codegenConfig, $this->cg, $this->jsonSchemaCodegenConfig, $this->schema, $class, $file);
  }

  public function setCreateAbstractClass(bool $abstract): this {
    $this->createAbstract = $abstract;
    return $this;
  }

  public function setGeneratedFrom(CodegenGeneratedFrom $generated_from): this {
    $this->builder->getFile()->setGeneratedFrom($generated_from);
    return $this;
  }

  public function setDiscardChanges(bool $discard): this {
    $this->builder->getFile()->setDoClobber($discard);
    return $this;
  }

  public function setSanitizeString(?Codegen::TSanitizeStringConfig $sanitize_string): this {
    $this->sanitizeString = $sanitize_string;
    return $this;
  }

  public function getBuilder(): RootBuilder {
    return $this->builder;
  }

  public function build(): CodegenFile {
    $this->builder->build();

    $abstract = $this->createAbstract;
    $class = $this->builder
      ->getClass()
      ->setExtends("JsonSchema\BaseValidator<{$this->builder->getType()}>")
      ->setIsAbstract($abstract)
      ->setIsFinal(!$abstract)
      ->addMethod($this->getCodegenClassProcessMethod());

    $file = $this->builder->getFile();
    $file->addClass($class);

    $contents = $file->render();
    if (Str\contains($contents, 'Constraints\\')) {
      $file->useNamespace('Slack\Hack\JsonSchema\Constraints');
    }

    $file->save();
    return $file;
  }

  private function getCodegenClassProcessMethod(): CodegenMethod {
    $hb = new HackBuilder($this->hackCodegenConfig);
    $hb->addMultilineCall('return self::check', vec['$this->input', '$this->pointer']);

    return $this->cg
      ->codegenMethod('process')
      ->setReturnType($this->builder->getType())
      ->addEmptyUserAttribute('__Override')
      ->setProtected()
      ->setBody($hb->getCode());
  }

}
