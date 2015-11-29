<?php
require_once 'src/db.php';
class Tag {
  public $name, $id;

  public function __construct($id, $name){
    $this->name = $name;
    $this->id = $id;
  }

  public static function all($user){
    $query = DB::connection()->prepare('SELECT * FROM Tag WHERE owner = :owner ORDER BY id ASC');
    $query->execute(array('owner' => $user->id));
    $rows = $query->fetchAll();
    $tags = array();

    foreach($rows as $row){
      $tags[] = new Tag($row['id'], $row['name']);
    }
    return $tags;
  }

  public static function findById($id){
    $query = DB::connection()->prepare('SELECT * FROM Tag WHERE Tag.id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      return new Tag($row['id'], $row['name']);
    } else {
      return null;
    }
  }

  public function save(){
  }
}
