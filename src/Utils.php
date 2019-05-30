<?hh // strict

namespace Slack\Hack\JsonSchema;

function get_pointer(string $current, string ...$parts): string {
  $encoded = \HH\Lib\Vec\map($parts, $path ==> encode_path($path))
    |> \HH\Lib\Str\join($$, '/');

  return $current ? "{$current}/{$encoded}" : "/{$encoded}";
}

/**
* Encode paths within the pointer according to RFC-6901
* (https://tools.ietf.org/html/rfc6901)
*/
function encode_path(string $path): string {
  return \strtr($path, dict['/' => '~1', '~' => '~0']);
}

function json_decode_hack(mixed $json): mixed {
  return \json_decode(
    $json,
    true, /* default stack_depth */
    512,
    \JSON_FB_HACK_ARRAYS,
  );
}
