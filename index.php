<?php
include __DIR__ . '/tinyhooks.php';

hook::set('myhook', function($args) {
  return 'Hello ' . $args;
});

echo hook('myhook', 'world');