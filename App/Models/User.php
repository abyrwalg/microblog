<?php

namespace App\Models;

class User extends Model {

  public const TABLE = "users";

  public $login;
  public $name;
  public $email;
  public $password;
  public $avatar;

}