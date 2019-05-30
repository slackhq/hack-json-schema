<?hh // strict

namespace Slack\Hack\JsonSchema\Codegen;

use namespace \HH\Lib\{Str, C};

use namespace Slack\Hack\JsonSchema;

trait RefResolver {
  protected Context $ctx;

  protected function resolveRef(string $ref, Context $ctx): (TSchema, ?string) {
    $current_schema = null;
    $new_root_path = null;
    $original_ref = $ref;

    // Resolve any file references
    if ($ref[0] !== '#') {
      $root_directory = $ctx->getRefsRootDirectory();
      if ($root_directory === null) {
        $root_directory = __DIR__;
      } else {
        $root_directory = \realpath($root_directory);
      }

      $paths = $this->splitRefPaths($ref);
      $full_path = $root_directory."/".$paths[0];
      $new_root_path = \realpath($full_path);
      if ($new_root_path === false)
        throw new \Exception("Error resolving reference: {$full_path}");

      $current_schema = $this->loadSchema($new_root_path);
      $current_file_name = Str\split($new_root_path, '/') |> C\last($$) ?? '';
      $ctx->setCurrentRefFileName($current_file_name);

      if ($current_schema === null)
        throw
          new \Exception("Failed reading schema: `{$new_root_path}`, `{$ref}`");

      if ($ctx->hasSeenRef($new_root_path)) {
        throw new JsonSchema\CircularReferenceException(
          "Circular reference beginning at {$original_ref}",
        );
      } else {
        $ctx->acknowledgeRef($new_root_path);
      }

      $ctx->setRootSchema($current_schema);
      $ref = "#".($paths[1] ?? "");
    } else {
      // Prefer the root schema to resolve references within, falling back to
      // the current schema that has been loaded.
      $current_schema = $ctx->getRootSchema() ?? $ctx->getSchema();
    }

    // Find the schema the `ref` is pointing to

    $ref = \substr($ref, 1);
    $pointers = \HH\Lib\Str\split($ref, '/') |> \HH\Lib\Vec\filter($$);

    while (C\count($pointers)) {
      $pointer = $pointers[0];
      $pointers = \HH\Lib\Vec\drop($pointers, 1);
      $array_schema = Shapes::toArray($current_schema);
      $next_schema = $array_schema[$pointer] ?? null;

      if ($next_schema === null) {
        throw
          new \Exception("Failed resolving ref: {$pointer} in {$original_ref}");
      }

      $typed = type_assert_shape(
        $next_schema,
        'Slack\Hack\JsonSchema\Codegen\TSchema',
      );
      $current_schema = $typed;
    }

    return tuple($current_schema, $new_root_path);
  }

  /**
  * Return just the path to the file within a ref.
  */
  protected function getRefFilePath(string $ref): string {
    if ($ref[0] === '#')
      return '';
    $paths = $this->splitRefPaths($ref);
    return $paths[0];
  }

  /**
  * Return just the path to the schema within a ref.
  */
  protected function getRefSchemaPath(string $ref): string {
    if ($ref[0] === '#')
      return \substr($ref, 1);

    $paths = $this->splitRefPaths($ref);
    return $paths[1] ?? '';
  }

  /**
  * Separate the path to the file from the path to the schema with than file.
  *
  * For example, a ref might look like:
  *
  * { "$ref": "../../common/defs.json#/devices/tablet" }
  */
  protected function splitRefPaths(string $ref): vec<string> {
    $paths = \HH\Lib\Vec\filter(\HH\Lib\Str\split($ref, '#'));
    if ($paths[0][0] === "/")
      $paths[0] = \substr($paths[0], 1);

    return $paths;
  }

  protected function loadSchema(string $fp): ?TSchema {
    $contents = \file_get_contents($fp);
    if (!$contents)
      return null;

    $schema = \json_decode(
      $contents,
      true, /* default stack_depth */
      512,
      \JSON_FB_HACK_ARRAYS,
    );

    if ($schema === null)
      throw new \Exception("Failed decoding schema: `{$fp}`");

    return type_assert_shape($schema, 'Slack\Hack\JsonSchema\Codegen\TSchema');
  }

}
