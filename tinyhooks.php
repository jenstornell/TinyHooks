<?php
class hook {
  public static function set($name, $method) {
    $GLOBALS['hooks'][$name][] = $method;
  }

  public static function get($name, $data = []) {
    $out = '';
    foreach($GLOBALS['hooks'][$name] as $filter) {
      $out .= $filter($data);
    }
    return $out;
  }
}

// Helper for hook::get()
function hook($name, $data = []) {
  return hook::get($name, $data);
}