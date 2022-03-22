<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\C;

final class RefCache {

  static private dict<string, Codegen> $generatedRefs = dict[];

  //
  // Run this resetCache before using any other method
  //

  static public function resetCache(): void {
    RefCache::$generatedRefs = dict[];
  }

  //
  // Cache the ref by passing in a CodegenFile object. The $refName should be
  // the full pathname of the file.
  //

  static public function cacheRef(string $refName, Codegen $codegen): void {
    RefCache::$generatedRefs[$refName] = $codegen;
  }

  //
  // Check if a CodegenFile already exists for the particular $refName
  //

  static public function isRefCached(string $refName): bool {
    return C\contains_key(RefCache::$generatedRefs, $refName);
  }

  //
  // Do not use this function unless you have already verified that a
  // Codegen exists for $refName. This function will not gracefully
  // handle the case when $refName is not found in the cache.
  //

  static public function getCachedCodegen(string $refName): Codegen {
    return RefCache::$generatedRefs[$refName];
  }
}
