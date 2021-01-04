<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Post;

class Index extends Controller {
  public function display() {
    echo $this->view->render(__DIR__ . "/../../templates/index.php");
  }

  public function __invoke() {
    $this->view->posts = Post::findAll();
    $this->display();
  }
}