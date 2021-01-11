<?php

namespace App\Models;
use App\Models\User;
use App\Db;

class Post extends Model {

  public const TABLE = "posts";

  public $author;
  public $date;
  public $content;
  public $imagesFolder;
  public $images;

  private function generateRandomString($length = 10) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function publish($images = []) {
    $this->content = htmlspecialchars($this->content);
    $this->imagesFolder = $_SESSION["id"] . static::generateRandomString();
    
    $this->images = "";

    if (count($images) > 0) {
      foreach($images as $image) {
        $fileExtension = end(explode(".", $image));
        if (!file_exists(__DIR__ . "/../../assets/images/posts/" . $this->imagesFolder)) {
          mkdir(__DIR__ . "/../../assets/images/posts/" . $this->imagesFolder);
        }
        $filePath = __DIR__ . "/../../assets/images/posts/" . $this->imagesFolder . "/";
        $fileName = md5($image) . "." . $fileExtension;
        rename($image, $filePath . $fileName);
        $this->images .= "$this->imagesFolder/$fileName,";
      }
    } 

    $this->save();
  }
}