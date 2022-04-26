namespace Slack\Hack\JsonSchema\Codegen\Typing;

/**
 * The various types which have names in the Hack type system.
 *
 * In reality, this isn't everything, but it's enough for our purposes.
 */
enum ConcreteTypeName: string {
  ARRAYKEY = 'arraykey';
  BOOL = 'bool';
  DICT = 'dict';
  INT = 'int';
  KEYSET = 'keyset';
  NONNULL = 'nonnull';
  NOTHING = 'nothing';
  NUM = 'num';
  SHAPE = 'shape';
  STRING = 'string';
  VEC = 'vec';
}
