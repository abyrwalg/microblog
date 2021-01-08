<?php

namespace App\Models;

use App\Db;

abstract class Model {

  public const TABLE = "";
  public $id;

  public static function findAll() {
    $db = new Db();
    $sql = "SELECT * FROM " . static::TABLE;
    return $db->query($sql, [], static::class);
  }

  public static function findById($id) {
    $db = new Db();
    $sql = "SELECT * FROM " . static::TABLE . " WHERE id=:id";
    $data = $db->query($sql, [":id" => $id], static::class);
    return $data[0];
  }

  public function save() {
    $fields = get_object_vars($this);
    $columns = [];
    $data = [];
    foreach ($fields as $name => $value) {
      if ($name === "id") {
        continue;
      }
      $columns[] = $name;
      $data[":" . $name] = $value;
    }

    $sql = "INSERT INTO " . static::TABLE . " (". implode(",", $columns) .") VALUES (" . implode(",", array_keys($data)) . ")";
    //Check if object already exists in database and switch to UPDATE statement if true
    if ($this->id) {
      $data[":id"] = $this->id;
      $paramsString = "";
      $i = 0;
      $len = count($columns);
      foreach ($columns as $column) {
        if ($i === $len - 1) {
          $paramsString .= $column . "=:" . $column;
        } else {
          $paramsString .= $column . "=:" . $column . ", "; 
        }
        $i++;
      }
      $sql = "UPDATE " . static::TABLE . " SET " . $paramsString . " WHERE id=:id";
    }
    
    $db = new Db();
    $db->execute($sql, $data);

    $this->id = $db->getLastId();
  }



}
