<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use App\Db;

class Register extends Controller {

  private $validity = true;

  public function display() {
    echo $this->view->render(__DIR__ . "/../../templates/register.php");
  }

  public function register() {
    $user = new User();
    $user->login = $_POST["login"];
    $user->name = $_POST["login"];
    $user->email = $_POST["email"];
    $user->password = $_POST["password"];
    $user->avatar = "-";
    $this->validateUser($user);
    if ($this->validity) {
      $user->password = password_hash($user->password, PASSWORD_DEFAULT);
      $user->save();
      header("Location: /microblog");
    } else {
      $this->display();
    }
  }

  private function validateUser($user) {
   
    $validityData = 
    [ 
      //0 => validity (Bootstrap class), 1 => errorMessage, 2 => input value
      "login" => ["", "", ""],
      "email" => ["", "", ""],
      "password" => ["", "", ""],
      "passwordConfirm" => ["", "", ""],
    ];

    if ($user->login === "" || $user->name === "") {
      $this->validity = false;
      $validityData["login"] = ["is-invalid", "Некорректное имя пользователя", ""];
    } else {
      $validityData["login"] = ["is-valid", "", $user->login];
    }

    if (preg_match('/[^A-Za-z0-9]/', $user->login) && $validityData["login"][0] === "is-valid") {
      $this->validity = false;
      $validityData["login"] = ["is-invalid", "Имя пользователя должно содержать только символы латинского алфавита и цифры", $user->login];
    }

    //Check if user with given login already exists
    if ($validityData["login"][0] === "is-valid") {
      $db = new Db();
      $sql = "SELECT * FROM users WHERE login=:login";
      $userFromDB = $db->query($sql, [":login" => $user->login], "App\Models\User");
      if (!empty($userFromDB)) {
        $this->validity = false;
        $validityData["login"] = ["is-invalid", "Такое имя пользователя уже существует", "$user->login"];
      }
    }

    if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
      $this->validity = false;
      $validityData["email"] = ["is-invalid", "Некорректный email", $user->email];
    } else {
      $validityData["email"] = ["is-valid", "", $user->email];
    }

    //Check if email is already in use
    if ($validityData["email"][0] === "is-valid") {
      $db = new Db();
      $sql = "SELECT * FROM users WHERE email=:email";
      $userFromDB = $db->query($sql, [":email" => $user->email], "App\Models\User");
      if (!empty($userFromDB)) {
        $this->validity = false;
        $validityData["email"] = ["is-invalid", "Этот email уже используется", "$user->email"];
      }
    }

    if (strlen($user->password) < 8) {
      $this->validity = false;
      $validityData["password"] = ["is-invalid", "Длина пароля меньше 8 символов", ""];
    } else {
      $validityData["password"] = ["is-valid", "", $user->password];
    }

    if ($user->password !== $_POST["passwordConfirm"] || $user->password === "") {
      $this->validity = false;
      $validityData["passwordConfirm"] = ["is-invalid", "Пароли не совпадают", ""];
    } else {
      $validityData["passwordConfirm"] = ["is-valid", "", $_POST["passwordConfirm"]];
    }

    $this->view->validity = $validityData;
  }
} 