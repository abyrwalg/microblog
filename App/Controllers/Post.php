<?php

namespace App\Controllers;

session_start();

use App\Controllers\Controller;
use App\Models\User;

class Post extends Controller {
  public function display() { 
    $this->view->post = \App\Models\Post::findById($_GET["id"]);
    $this->view->post->user = User::findById($this->view->post->author);
    echo $this->view->render(__DIR__ . "/../../templates/post.php");
  }

  public function __invoke() {
    $user = User::findById($_SESSION["id"]);
    if (!isset($user)) {
      echo "User is not logged in";
      return;
    }
    $post = new \App\Models\Post();
    $post->author = $_SESSION["id"];
    $post->date = date("Y-m-d H:i:s");
    $post->content = $_POST["post"];

    foreach ($_FILES as $file) {
      if (getimagesize($file["tmp_name"])) {
        $filePath = __DIR__ . "/../../assets/images/tmp/" . rand(0, 2048) . $file["name"];
        $images[] = $filePath;
        move_uploaded_file($file["tmp_name"], $filePath);
      }
    }

    $post->publish($images);
    echo json_encode(["message" => "success"]);
  }
}