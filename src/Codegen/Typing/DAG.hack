namespace Slack\Hack\JsonSchema\Codegen\Typing;

use namespace HH\Lib\{C, Keyset, Vec};

/**
 * A DAG over a set of key. Exposes efficient operations
 * to compute the lowest upper bound (LUB).
 */
final class DAG<T as arraykey> {
  private keyset<T> $vertices = keyset[];
  private dict<T, keyset<T>> $children = dict[];
  private dict<T, keyset<T>> $parents = dict[];

  /**
   * Instantiate the DAG from an adjacency list in which keys are parent vertices
   * and values are lists of their children.
   */
  public static function fromAdjacencyList(dict<T, keyset<T>> $adjacency_list): this {
    $dag = new self();
    foreach ($adjacency_list as $parent => $children) {
      $dag->vertices[] = $parent;
      foreach ($children as $child) {
        $dag->vertices[] = $child;

        $dag->children[$parent] ??= keyset[];
        $dag->children[$parent][] = $child;

        $dag->parents[$child] ??= keyset[];
        $dag->parents[$child][] = $parent;
      }
    }
    return $dag;
  }

  /**
   * Compute the lowest upper bound of a set of vertices.
   *
   * The lowest upper bound is the vertex which is a parent of all vertices
   * in the set and has more ancestors than any other vertex which is a
   * parent of all vertices in the set.
   *
   * Returns null if the set of vertices is empty.
   */
  public function computeLowestUpperBound(keyset<T> $vertices): ?T {
    return Vec\map($vertices, $vertex ==> $this->getAncestorsWithSelf($vertex))
      // This hacky-looking syntax takes the intersection of all ancestors identified by the above map.
      |> Keyset\intersect(($$[0] ?? keyset[]), ($$[1] ?? $$[0] ?? keyset[]), ...Vec\drop($$, 2))
      |> Vec\sort_by($$, $vertex ==> $this->getNumAncestors($vertex))
      |> C\last($$);
  }

  /**
   * Get all parents of the given vertex.
   */
  private function getParents(T $vertex): keyset<T> {
    return $this->parents[$vertex] ?? keyset[];
  }

  /**
   * Get all ancestors of the given vertex.
   */
  private function getAncestors(T $vertex): keyset<T> {
    $ancestors = keyset[];
    foreach ($this->getParents($vertex) as $parent) {
      $ancestors[] = $parent;
      $ancestors = Keyset\union($ancestors, $this->getAncestors($parent));
    }
    return $ancestors;
  }

  /**
   * Get all ancestors of the given vertex and include the vertex as well.
   */
  private function getAncestorsWithSelf(T $vertex): keyset<T> {
    $ancestors = $this->getAncestors($vertex);
    $ancestors[] = $vertex;
    return $ancestors;
  }

  /**
   * Count the number of ancestors the vertex has.
   */
  private function getNumAncestors(T $vertex): int {
    return C\count($this->getAncestors($vertex));
  }
}
