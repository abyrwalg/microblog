<?php

namespace App\Controllers;

session_start();

use App\Controllers\Controller;
use App\Models\User;

class Profile extends Controller {
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
      $this->display();
    }
    
  }

  public function __invoke() {
    $user = User::findById($_SESSION["id"]);
    $this->view->userName = $user->name;
    $this->view->avatar = $user->avatar;
    $this->view->login = $user->login;
    $this->display();
  }
}