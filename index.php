<?php
include __DIR__ . '/tinyhooks.php';

hook::set('test', function($args) {
  return 'testing' . $args;
});

hook::set('test', function() {
  return 'abc123';
});

print_r($GLOBALS);

echo hook('test', 'hello');