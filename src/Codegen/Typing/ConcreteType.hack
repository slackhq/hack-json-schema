namespace Slack\Hack\JsonSchema\Codegen\Typing;

use namespace HH\Lib\{Str, Vec};

/**
 * Represents a concrete type in the Hack type system,
 * i.e., a type which cannot be satisfied by `null`
 * and which is not a type alias.
 *
 * Concrete types may contain generics. It may be possible to also
 * represent optional types as concrete types containing a single
 * generic, but using a separate type for optionals seemed like a simpler
 * approach for now.
 */
final class ConcreteType extends Type {
  public function __construct(private ConcreteTypeName $name, private vec<Type> $generics = vec[]) {}

  <<__Override>>
  public function getConcreteTypeName(): ConcreteTypeName {
    return $this->name;
  }

  <<__Override>>
  public function getGenerics(): vec<Type> {
    return $this->generics;
  }

  <<__Override>>
  public function hasAlias(): bool {
    return false;
  }

  <<__Override>>
  public function isOptional(): bool {
    return false;
  }

  <<__Override>>
  public function render(): string {
    $out = (string)$this->name;
    $generics = $this->getGenerics();
    if ($generics) {
      $out = $out.'<'.Str\join(Vec\map($generics, $generic ==> $generic->render()), ', ').'>';
    }
    // TODO: Handle shape fields
    return $out;
  }
}
