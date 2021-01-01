<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Article;

class Login extends Controller {
  public function display() {
    echo $this->view->render(__DIR__ . "/../../templates/login.php");
  }
}