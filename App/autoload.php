<?php

/* function __autoload($class) {
  require __DIR__ . "/../" .str_replace("\\", "/", $class). ".php";
}
 */

spl_autoload_register("autoLoader");

function autoLoader($class) {
  $path = __DIR__ . "/../" . str_replace("\\", "/", $class) . ".php";
  require_once $path;
}