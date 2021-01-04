<?php

require __DIR__ . "/App/autoload.php";

$ctrl = new App\Controllers\Login();

if (isset($_POST["login"]) && isset($_POST["password"])) {
  $ctrl->login();
} elseif (isset($_POST["logout"])) {
  $ctrl->logout();
} else {
  $ctrl->display();
}
 
