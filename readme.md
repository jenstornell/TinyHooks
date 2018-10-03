# TinyHooks

*Version: 1.0*

TinyHooks is perhaps the smallest PHP hook library on earth. Still packed with features.

## Setup

```php
include __DIR__ . '/tinyhooks.php';
```

## Basic usage

### Set by anonymous function

The most basic way to setup a hook is with a anonymus function like below.

```php
hook::set('myhook', function($args) {
  return 'Hello ' . $args;
});
```

### Trigger

Below will output `Hello world` on the screen, if you have set the hook like above.

```php
echo hook('myhook', 'world'); // Output will be "Hello world"
```

## Set by other types

### Function

If you use a string as a second argument, you will call a function.

```php
hook::set($name, 'about');

function about($args) {
  // Return something
}
```

### Static function

To call a static function you need to include the class name like below.

```php
hook::set($name, 'MyStatic::myhook');

class MyStatic {
  public static function myhook($args) {
    // Return something
  }
}
```

### Object function

To use a function in a class, you need to create an object. Then you need to send the object and the class name as an array, like below.

```php
$object = new MyClass();

hook($name, [$object, 'myhook']);

class MyClass {
  function myhook($args) {
    // Return something
  }
}
```

## Multiple hooks in one go

You can setup all your hooks with a single array. The `key` of every row is the pattern and the `value` is the call. That way it works very similar to the `hook::set()` function.

```php
hooks::set([ EJKLAR!!!!!!!!!!!!!!!!!!
  '/' => 'myFunction',
  'about/:any' => function($matches) {
    // Return something
  }
]);
```

## Donate

Donate to [DevoneraAB](https://www.paypal.me/DevoneraAB) if you want.

## Additional notes

- To keep it dead simple, namespaces are not used.
- In case of collision, you can rename the `hook` class and the `hook` function.

## Requirements

- PHP 7

## Inspiration

- [Kirby CMS hooks](https://getkirby.com/docs/developer-guide/advanced/hooks) General inspiration.
- [WordPress hooks](https://codex.wordpress.org/Plugin_API#Hook_to_WordPress) General inspiration.

## License

MIT