<?php
spl_autoload_register(function($class){
    $path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";
    require_once($path);
  });
?>