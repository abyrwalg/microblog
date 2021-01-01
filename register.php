<?php

require __DIR__ . "/App/autoload.php";

$ctrl = new App\Controllers\Register();
if (isset($_POST["name"])) {
  $ctrl->register();
} else {
  $ctrl->display();
}