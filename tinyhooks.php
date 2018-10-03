<?php
class hook {
  public static function set($name, $method) {
    global $hooks;
    $hooks[$name][] = $method;
  }

  public static function trigger($name, $args = []) {
    global $hooks;

    if(!empty($hooks)) {
      $firstcall = self::call($hooks[$name][0], $args);
      $type = gettype($firstcall);
      $out = $type == 'string' ? '' : [];

      foreach($hooks[$name] as $hook) {
        if($type == 'string')
          $out .= self::call($hook, $args);
        else
          $out[] = self::call($hook, $args);
      }
    }
    return $out;
  }

  function call($hook, $args) {
    switch(gettype($hook)) {
      case 'object':
        return $hook($args);
        break;
      case 'string':
        return call_user_func_array($hook, [$args]);
        break;
      case 'array':
        return call_user_func_array([$hook[0], $hook[1]], [$args]);
        break;
    }
  }
}

// Helper for hook::trigger()
function hook($name, $args = []) {
  return hook::trigger($name, $args);
}