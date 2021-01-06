<?php

namespace App\Controllers;

session_start();

use App\Controllers\Controller;
use App\Models\User;

class Login extends Controller {
  public function display() {
    echo $this->view->render(__DIR__ . "/../../templates/login.php");
  }

  public function login() {
    $user = User::login($_POST["login"], $_POST["password"]);
    $_SESSION["login"] = $user->login;
    $_SESSION["id"] = $user->id;
    $_SESSION["avatar"] = $user->avatar;
    if (isset($user)) {
      header("Location: /microblog");
    } else {
      $this->view->loginFail = true;
      $this->display();
    }
  }

  public function logout() {
    session_unset();
    echo json_encode(["message"=> "logging out"]);
  }
}