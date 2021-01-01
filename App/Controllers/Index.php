<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Article;

class Index extends Controller {
  public function display() {
    echo $this->view->render(__DIR__ . "/../../templates/index.php");
  }
}