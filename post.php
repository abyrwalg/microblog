<?php

require __DIR__ . "/App/autoload.php";
$ctrl = new App\Controllers\Post();
if (isset($_POST["post"])) {
  $ctrl();
} else {
  $ctrl->display();
}