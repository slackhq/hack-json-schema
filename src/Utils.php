<?hh // strict

namespace Slack\Hack\JsonSchema;

use namespace HH\Lib\{Str, Vec};

function get_pointer(string $current, string ...$parts): string {
  $encoded = Vec\map($parts, $path ==> encode_path($path))
    |> Str\join($$, '/');

  return !Str\is_empty($current) ? "{$current}/{$encoded}" : "/{$encoded}";
}

function get_function_name_from_function(mixed $function): string {
  $func_name = '';
  $is_function = \is_callable_with_name($function, false, inout $func_name);
  invariant($is_function, 'You may only pass named functions to %s', __FUNCTION__);
  return $func_name;
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
    (string)$json,
    true, /* default stack_depth */
    512,
    \JSON_FB_HACK_ARRAYS,
  );
}
