<?php

namespace App\Models;
use App\Db;

class User extends Model {

  public const TABLE = "users";

  public $login;
  public $name;
  public $email;
  public $password;
  public $avatar;
  public $about;

  public static function login($login, $password) {
    $sql = "SELECT * FROM users WHERE login=:login";
    $db = new Db();
    $user = $db->query($sql, [":login" => $login], static::class)[0];
    if (password_verify($password, $user->password)) {
      return $user;
    }
  }

}