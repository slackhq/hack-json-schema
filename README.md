# Hack JSON Schema
Hack JSON Schema is a library for validating JSON inputs, using JSON schemas, in Hack. Given a JSON schema file, you can generate a validator in Hack to validate incoming JSON against the schema. If the JSON conforms to the schema, the validator will returned typed output.

There are several benefits to generation:

- We don't have to parse the JSON schema to validate the incoming object at runtime.
- We can output typed shapes that are generated from the JSON schema, increasing the type safety of downstream code.

## Usage

### Codegen::forPath
The most basic way to use this library is to generate a validator from a JSON schema file:

```
use type Slack\Hack\JsonSchema\Codegen\Codegen;

Codegen::forPath('/path/to/json-schema.json', shape(
  'validator' => shape(
    'file' => '/path/to/MyJsonSchemaValidator.php',
    'class' => 'MyJsonSchemaValidator',
  ),
))->build();
```

`/path/to/MyJsonSchemaValidator.php` now exists with a class:

```
final class MyJsonSchemaValidator extends BaseValidator {
  ... class contents
}
```

Each validator has a `validate` method, which takes a decoded JSON object:

```
$json = json_decode($args['json_input'], true);
$validator = new MyJsonSchemaValidator($json);
$validator->validate();
if (!$validator->isValid()) {
  print_r("invalid_json", $validator->getErrors());
  return;
}

// JSON is valid, get typed object:
$validated = $validator->getValidatedInput();
```

### Codegen::forPaths
If you have multiple JSON schemas that leverage the `$ref` attribute, you should prefer to use `Codegen::forPaths` over `Codegen::forPath`.

The workflow for `Codegen::forPath` is:
- Given a JSON schema, "de-reference" the schema. De-referencing is the process of resolving all of the `$ref` paths with their actual schema. This creates a single de-referenced schema.
- With the de-referenced schema, generate a validator.

This works well if you only have one primary schema, but if you have multiple schemas, each with common refs, you'll start to generate a lot of duplicate code.

In these cases, you can use `Codegen::forPaths`.

```
use type Slack\Hack\JsonSchema\Codegen\Codegen;

$schemas = vec['/path/to/json-schema-1.json', '/path/to/json-schema-2.json', '/path/to/json-schema-3.json'];
Codegen::forPaths($schemas, shape(
  'validator' => shape(
    'refs' => shape(
       'unique' => shape(
          'source_root' => '/path/to',
          'output_root' => '/path/gen'
        )
     )
  ),
))->build();
```

By defining the `source_root` and `output_root` we can generate unique validators per `$ref` we come across. We can then re-use those validators when generating other validators.

## Developing

### Installing Dependencies
We use composer to install our dependencies. Running the following will install composer (if it doesn't exist already) and install the dependencies:

```
make composer-install
```

### Running Tests
```
make test
```

## Related Libraries
This library was inspired by the ideas in these related libraries:

- https://github.com/hhvm/hack-router-codegen
- https://github.com/justinrainbow/json-schema

## License
Hack JSON Schema is MIT-licensed.
