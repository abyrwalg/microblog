<?php

namespace App\Controllers;

session_start();

use App\Controllers\Controller;
use App\Models\User;

class Profile extends Controller {

  private $validity = true;

  public function display() { 
    echo $this->view->render(__DIR__ . "/../../templates/profile.php");
  }

  public function uploadAvatar() {
    $user = User::findById($_SESSION["id"]);
    if (getimagesize($_FILES["avatar"]["tmp_name"])) {
      //Get file extenstion
      $fileExtension = end(explode(".", $_FILES['avatar']['name']));
      
      //Delete previous avatar if not default
      if ($user->avatar !== "assets/images/icons/default-avatar.png") {
        unlink(__DIR__ . "/../../" . $user->avatar);
      }
      move_uploaded_file($_FILES["avatar"]["tmp_name"], __DIR__ . "/../../assets/images/avatars/" . $user->id . "." . $fileExtension);
      $user->avatar = "assets/images/avatars/" . $user->id . "." . $fileExtension;
      $user->save();
      $_SESSION["avatar"] = $user->avatar;
    }
    
  }

  public function updateInfo() {
    $user = User::findById($_SESSION["id"]);
    
    if (isset($_POST["name"])) {
      $user->name = trim(htmlspecialchars($_POST["name"]));
    }

    if (isset($_POST["about"])) {
      $user->about = trim(htmlspecialchars($_POST["about"]));
    }
    
    $this->validateInfo($user);
    if ($this->validity) {
      $user->save();
      $this();
    } else {
      $this();
    }
    
  }

  private function validateInfo($user) {
    $validityData = 
    [ 
      //0 => validity (Bootstrap class), 1 => errorMessage, 2 => input value
      "name" => ["", "", ""],
      "about" => ["", "", ""]
    ];

    if (mb_strlen(trim($user->name)) > 40) {
      $this->validity = false;
      $validityData["name"] = ["is-invalid", "Длина имени не должна превышать 40 символов", $user->name];
    } elseif (trim($user->name) === "") {
      $this->validity = false;
      $validityData["name"] = ["is-invalid", "Некорректное имя пользователя", ""];
    } else {
      $validityData["name"] = ["is-valid", "", $user->name];
    }

    if (mb_strlen(trim($user->about)) > 180) {
      $this->validity = false;
      $validityData["about"] = ["is-invalid", "Длина поля не должна превышать 180 символов", $user->about];
    } else {
      $validityData["about"] = ["is-valid", "", $user->about];
    }

    $this->view->validity = $validityData;
  }

  public function __invoke() {
    $user = User::findById($_SESSION["id"]);
    $this->view->userName = $user->name;
    $this->view->avatar = $user->avatar;
    $this->view->login = $user->login;
    $this->view->about = $user->about;
    $this->display();
  }
}