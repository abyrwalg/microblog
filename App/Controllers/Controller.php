<?php

namespace App\Controllers;

use App\View;
use App\Models\Article;

abstract class Controller {

  protected $view;

  public function __construct() {
    $this->view = new View();
  }

  abstract public function display();

}