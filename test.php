<?php
class hook {
  public static function set($name, $method) {
    $GLOBALS['hooks'][$name][] = $method;
  }

  public static function trigger($name, $data = []) {
    $out = '';
    foreach($GLOBALS['hooks'][$name] as $filter) {
      $out .= $filter($data);
    }
    return $out;
  }
}

hook::set('test', function($args) {
  return 'Hello ' . $args;
});

echo hook::trigger('test', 'world');