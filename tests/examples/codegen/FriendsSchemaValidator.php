<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run `make test`
 *
 *
 * @generated SignedSource<<43e3e99c9d0969475a40615b03e7a4c2>>
 */
namespace Slack\Hack\JsonSchema\Tests\Generated;
use namespace Slack\Hack\JsonSchema;
use namespace Slack\Hack\JsonSchema\Constraints;

type TFriendsSchemaValidatorItemsPropertiesNanDevicesNanItems = shape(
  'model' => string,
  ?'carrier/provider' => string,
  ...
);

type TFriendsSchemaValidatorItemsPropertiesEmptyObject = dict<string, mixed>;

type TFriendsSchemaValidatorItems = shape(
  'first_name' => string,
  'last_name' => string,
  ?'age' => int,
  ?'~devices/' => vec<TFriendsSchemaValidatorItemsPropertiesNanDevicesNanItems>,
  ?'enemies' => mixed,
  ?'rating' => vec<mixed>,
  ?'contact' => vec<mixed>,
  ?'empty_object' => TFriendsSchemaValidatorItemsPropertiesEmptyObject,
  ...
);

final class FriendsSchemaValidatorItemsPropertiesFirstName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsPropertiesLastName {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsPropertiesAge {

  private static int $minimum = 0;
  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    Constraints\NumberMinimumConstraint::check(
      $typed,
      self::$minimum,
      $pointer,
    );
    return $typed;
  }
}

final class FriendsSchemaValidatorItemsPropertiesNanDevicesNanItemsPropertiesModel {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsPropertiesNanDevicesNanItemsPropertiesCarrierNanProvider {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsPropertiesNanDevicesNanItems {

  private static keyset<string> $required = keyset[
    'model',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TFriendsSchemaValidatorItemsPropertiesNanDevicesNanItems {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'model')) {
      try {
        $output['model'] = FriendsSchemaValidatorItemsPropertiesNanDevicesNanItemsPropertiesModel::check(
          $typed['model'],
          JsonSchema\get_pointer($pointer, 'model'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'carrier/provider')) {
      try {
        $output['carrier/provider'] = FriendsSchemaValidatorItemsPropertiesNanDevicesNanItemsPropertiesCarrierNanProvider::check(
          $typed['carrier/provider'],
          JsonSchema\get_pointer($pointer, 'carrier/provider'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }
}

final class FriendsSchemaValidatorItemsPropertiesNanDevicesNan {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TFriendsSchemaValidatorItemsPropertiesNanDevicesNanItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = FriendsSchemaValidatorItemsPropertiesNanDevicesNanItems::check(
          $value,
          JsonSchema\get_pointer($pointer, (string) $index),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class FriendsSchemaValidatorItemsPropertiesEnemies {

  public static function check(mixed $input, string $pointer): mixed {
    $typed = Constraints\NullConstraint::check($input, $pointer);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsItemsPropertiesRating0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsItemsPropertiesRating1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsPropertiesRating {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<mixed> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];
    $constraints = vec[
      class_meth(FriendsSchemaValidatorItemsItemsPropertiesRating0::class, 'check'),
      class_meth(FriendsSchemaValidatorItemsItemsPropertiesRating1::class, 'check'),
    ];

    foreach ($typed as $index => $value) {
      try {
        if ($index < \HH\Lib\C\count($constraints)) {
          $constraint = $constraints[$index];
          $output[] = $constraint(
            $value,
            JsonSchema\get_pointer($pointer, (string) $index),
          );
        } else {
          $error = shape(
            'code' => JsonSchema\FieldErrorCode::INVALID_TYPE,
            'message' => 'additional items not allowed in array',
          );
          throw new JsonSchema\InvalidFieldException($pointer, vec[$error]);
        }
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class FriendsSchemaValidatorItemsItemsPropertiesContact0 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): int {
    $typed =
      Constraints\IntegerConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsItemsPropertiesContact1 {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): string {
    $typed = Constraints\StringConstraint::check($input, $pointer, self::$coerce);

    return $typed;
  }
}

final class FriendsSchemaValidatorItemsPropertiesContact {

  private static bool $coerce = false;

  public static function check(mixed $input, string $pointer): vec<mixed> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];
    $constraints = vec[
      class_meth(FriendsSchemaValidatorItemsItemsPropertiesContact0::class, 'check'),
      class_meth(FriendsSchemaValidatorItemsItemsPropertiesContact1::class, 'check'),
    ];

    foreach ($typed as $index => $value) {
      try {
        if ($index < \HH\Lib\C\count($constraints)) {
          $constraint = $constraints[$index];
          $output[] = $constraint(
            $value,
            JsonSchema\get_pointer($pointer, (string) $index),
          );
        } else {
          $output[] = $value;
        }
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }
}

final class FriendsSchemaValidatorItemsPropertiesEmptyObject {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TFriendsSchemaValidatorItemsPropertiesEmptyObject {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some functions generated with this statement do not use their $output, they use their $typed instead*/
    $output = dict[];

    return $typed;
  }
}

final class FriendsSchemaValidatorItems {

  private static keyset<string> $required = keyset[
    'first_name',
    'last_name',
  ];
  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): TFriendsSchemaValidatorItems {
    $typed = Constraints\ObjectConstraint::check($input, $pointer, self::$coerce);
    Constraints\ObjectRequiredConstraint::check(
      $typed,
      self::$required,
      $pointer,
    );

    $errors = vec[];
    $output = shape();

    /*HHAST_IGNORE_ERROR[UnusedVariable] Some loops generated with this statement do not use their $value*/
    foreach ($typed as $key => $value) {
      /* HH_IGNORE_ERROR[4051] allow dynamic access to preserve input. See comment in the codegen lib for reasoning and alternatives if needed. */
      $output[$key] = $value;
    }

    if (\HH\Lib\C\contains_key($typed, 'first_name')) {
      try {
        $output['first_name'] = FriendsSchemaValidatorItemsPropertiesFirstName::check(
          $typed['first_name'],
          JsonSchema\get_pointer($pointer, 'first_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'last_name')) {
      try {
        $output['last_name'] = FriendsSchemaValidatorItemsPropertiesLastName::check(
          $typed['last_name'],
          JsonSchema\get_pointer($pointer, 'last_name'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'age')) {
      try {
        $output['age'] = FriendsSchemaValidatorItemsPropertiesAge::check(
          $typed['age'],
          JsonSchema\get_pointer($pointer, 'age'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, '~devices/')) {
      try {
        $output['~devices/'] = FriendsSchemaValidatorItemsPropertiesNanDevicesNan::check(
          $typed['~devices/'],
          JsonSchema\get_pointer($pointer, '~devices/'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'enemies')) {
      try {
        $output['enemies'] = FriendsSchemaValidatorItemsPropertiesEnemies::check(
          $typed['enemies'],
          JsonSchema\get_pointer($pointer, 'enemies'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'rating')) {
      try {
        $output['rating'] = FriendsSchemaValidatorItemsPropertiesRating::check(
          $typed['rating'],
          JsonSchema\get_pointer($pointer, 'rating'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'contact')) {
      try {
        $output['contact'] = FriendsSchemaValidatorItemsPropertiesContact::check(
          $typed['contact'],
          JsonSchema\get_pointer($pointer, 'contact'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\contains_key($typed, 'empty_object')) {
      try {
        $output['empty_object'] = FriendsSchemaValidatorItemsPropertiesEmptyObject::check(
          $typed['empty_object'],
          JsonSchema\get_pointer($pointer, 'empty_object'),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    /* HH_IGNORE_ERROR[4163] */
    return $output;
  }
}

final class FriendsSchemaValidator
  extends JsonSchema\BaseValidator<vec<TFriendsSchemaValidatorItems>> {

  private static bool $coerce = false;

  public static function check(
    mixed $input,
    string $pointer,
  ): vec<TFriendsSchemaValidatorItems> {
    $typed = Constraints\ArrayConstraint::check($input, $pointer, self::$coerce);

    $output = vec[];
    $errors = vec[];

    foreach ($typed as $index => $value) {
      try {
        $output[] = FriendsSchemaValidatorItems::check(
          $value,
          JsonSchema\get_pointer($pointer, (string) $index),
        );
      } catch (JsonSchema\InvalidFieldException $e) {
        $errors = \HH\Lib\Vec\concat($errors, $e->errors);
      }
    }

    if (\HH\Lib\C\count($errors)) {
      throw new JsonSchema\InvalidFieldException($pointer, $errors);
    }

    return $output;
  }

  <<__Override>>
  final protected function process(): vec<TFriendsSchemaValidatorItems> {
    return self::check($this->input, $this->pointer);
  }
}
