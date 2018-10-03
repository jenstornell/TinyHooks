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