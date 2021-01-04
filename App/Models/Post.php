<?php

namespace App\Models;
use App\Models\User;
use App\Db;

class Post extends Model {

  public const TABLE = "posts";

  public $author;
  public $date;
  public $content;


}