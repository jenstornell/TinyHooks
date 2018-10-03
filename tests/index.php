<?php
include __DIR__ . '/../tinyhooks.php';

// Anonymous function
hook::set('test', function($args) {
  return 'Hello ' . $args;
});

// Function
hook::set('test', 'myFunction');
function myFunction($args) {
  return 'Function ' . $args;
}

// Static function
hook::set('test', 'MyStatic::myFunction');
class MyStatic {
  public static function myFunction($args) {
    return 'Static ' . $args;
  }
}

// Object function
$object = new MyObject();
hook::set('test', [$object, 'myFunction']);
class MyObject {
  function myFunction($args) {
    return 'Object ' . $args;
  }
}
echo hook('test', "world\n");

// Multiple strings
hook::set('output', function() {
  return 'String';
});
hook::set('output', function() {
  return ' Another string';
});
echo hook('output');

// Multiple arrayes
hook::set('arrays', function() {
  return ['key' => 'value'];
});
hook::set('arrays', function() {
  return ['key2' => 'value2'];
});
print_r(hook('arrays'));

// Multiple objects
hook::set('objects', function() {
  return (object)['key' => 'value'];
});
hook::set('objects', function() {
  return (object)[
    'key2' => 'value2',
    'nested' => [
      'hello' => 'world'
    ]
  ];
});
print_r(hook('objects'));

//Multiple names
hook::set('name1', function() {
  return 'Hook for a single name' . "\n";
});
hook::set(['name1', 'name2'], function() {
  return 'Same hook for two names';
});

echo "name1:\n" . hook('name1') . "\n\n";
echo "name2:\n" . hook('name2') . "\n\n";

//Match by regex
hook::set('regex.*', function() {
  return 'Regex' . "\n";
});

echo hook('regex');
echo hook('regex123');

// Multiple hooks
hooks::set([
  [
    'multiple' => function($args) {
      return "From 1" .  $args . "\n";
    },
  ],
  [
    'multiple' => function($args) {
      return "From 2\n";
    }
  ]
]);

echo hook('multiple', ' Number one');