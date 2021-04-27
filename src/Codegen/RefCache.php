<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace HH\Lib\C;
use type Facebook\HackCodegen\CodegenFile;

final class RefCache {

  static private dict<string, CodegenFile> $generatedRefs = dict[];

  #
  # Run this resetCache before using any other method
  #

  static public function resetCache(): void {
    RefCache::$generatedRefs = dict[];
  }

  #
  # Cache the ref by passing in a CodegenFile object. The $refName should be
  # the full pathname of the file.
  #

  static public function cacheRef(string $refName, CodegenFile $file): void {
    RefCache::$generatedRefs[$refName] = $file;
  }

  #
  # Check if a CodegenFile already exists for the particular $refName
  #

  static public function isRefCached(string $refName): bool {
    return C\contains_key(RefCache::$generatedRefs, $refName);
  }

  #
  # Do not use this function unless you have already verified that a
  # CodegenFile exists for $refName. This function will not gracefully
  # handle the case when $refName is not found in the cache.
  #

  static public function getCachedFile(string $refName): CodegenFile {
    return RefCache::$generatedRefs[$refName];
  }
}
