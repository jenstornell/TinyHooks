<?php
class TinyHooks {
  public function set($pattern, $method) {
    global $hooks;
    if(is_array($pattern)) {
      foreach($pattern as $item) {
        $hooks[$item][] = $method;
      }
    } else $hooks[$pattern][] = $method;
  }

  public function sets($hooks) {
    foreach($hooks as $item) {
      $pattern = array_keys($item)[0];
      $this->set($pattern, $item[$pattern]);
    }
  }

  public function trigger($name, $args = []) {
    $this->args = $args;
    global $hooks;

    if(!empty($hooks)) {
      foreach($hooks as $hookname => $hook) {
        if(!$this->match($name, $hookname)) continue;

        $out = $this->initOut($hook);
        foreach($hook as $instance) {
          if(is_string($out))
            $out .= $this->call($instance);
          else
            $out[] = $this->call($instance);
        }
      }
    }
    return $out;
  }

  private function match($name, $hookname) {
    $regex = '~^' . $hookname . '$~';
    return preg_match($regex, $name);
  }

  private function initOut($hook) {
    $call = $this->call($hook[0]);
    return gettype($call) == 'string' ? '' : [];
  }

  private function call($hook) {
    switch(gettype($hook)) {
      case 'object':
        return $hook($this->args);
        break;
      case 'string':
        return call_user_func_array($hook, [$this->args]);
        break;
      case 'array':
        return call_user_func_array([$hook[0], $hook[1]], [$this->args]);
        break;
    }
  }
}

// HELPERS

// hook::trigger()
if(!function_exists('hook')) {
  function hook($name, $args = []) {
    $TinyHooks = new TinyHooks();
    return $TinyHooks->trigger($name, $args);
  }
}

// hook
if(!class_exists('hook')) {
  class hook {
    function set($pattern, $call) {
      $TinyHooks = new TinyHooks();
      $TinyHooks->set($pattern, $call);
    }
  }
}

// hooks::set()
if(!class_exists('hooks')) {
  class hooks {
    function set($hooks) {
      $TinyHooks = new TinyHooks();
      $TinyHooks->sets($hooks);
    }
  }
}