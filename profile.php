<?php
require __DIR__ . "/App/autoload.php";

session_start();


if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  die();
} 



$ctrl = new App\Controllers\Profile();

if (isset($_POST["name"]) || isset($_POST["about"])) {
  $ctrl->updateInfo();
  die();
}

if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
  $ctrl->uploadAvatar();
  die();
} 

$ctrl();

