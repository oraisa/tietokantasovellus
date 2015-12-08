<?php
require_once 'src/db.php';
require_once 'src/models/basemodel.php';
class Tag extends BaseModel{
  public $name, $id, $owner;

  public function __construct($id, $name, $owner){
    $this->validators = array('validate_name');

    $this->name = $name;
    $this->id = $id;
    $this->owner = $owner;
  }

  public static function all($user){
    $query = DB::connection()->prepare('SELECT * FROM Tag WHERE owner = :owner ORDER BY id ASC');
    $query->execute(array('owner' => $user->id));
    $rows = $query->fetchAll();
    $tags = array();

    foreach($rows as $row){
      $tags[] = new Tag($row['id'], $row['name'], $row['owner']);
    }
    return $tags;
  }

  public static function findById($id){
    $query = DB::connection()->prepare('SELECT * FROM Tag WHERE Tag.id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      return new Tag($row['id'], $row['name'], $row['owner']);
    } else {
      return null;
    }
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Tag(name, owner) VALUES (:name, :owner) RETURNING id');
    $query->execute(array('name' => $this->name, 'owner' => $this->owner));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function delete($user){
    if($user->id != $this->owner){
      return;
    }
    $query = DB::connection()->prepare('DELETE FROM Tag WHERE id = :id;');
    $query->execute(array('id' => $this->id));
  }

  public function update($user){
    if($user->id != $this->owner){
      return;
    }
    $query = DB::connection()->prepare('UPDATE Tag ' .
      'SET name = :name WHERE id = :id');
    $query->execute(array('name' => $this->name, 'id' => $this->id));
  }

  public function validate_name(){
    return $this->validate_string_max_length($this->name, 50, 'Nimi ei saa olla yli 50 merkkiä pitkä.');
  }
}
