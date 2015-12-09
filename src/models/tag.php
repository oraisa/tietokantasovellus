<?php
require_once 'src/db.php';
require_once 'src/models/basemodel.php';
class Tag extends BaseModel{
  public $name, $id, $owner, $parentIds;

  public function __construct($id, $name, $owner, $parents = array()){
    $this->validators = array('validate_name');

    $this->name = $name;
    $this->id = $id;
    $this->owner = $owner;
    $this->parentIds = $parents;
  }

  private function getParents(){
    $query = DB::connection()->prepare('SELECT parent FROM TagParent WHERE child = :id');
    $query->execute(array('id' => $this->id));
    $rows = $query->fetchAll();
    foreach($rows as $row){
      $this->parentIds[] = $row['parent'];
    }
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
    $db = DB::connection();
    $db->beginTransaction();
    $query = $db->prepare('INSERT INTO Tag(name, owner) VALUES (:name, :owner) RETURNING id');
    $query->execute(array('name' => $this->name, 'owner' => $this->owner));
    $row = $query->fetch();
    $this->id = $row['id'];
    $this->insertParents($db);
    $db->commit();
  }

  private function insertParents($db){
    foreach($this->parentIds as $parent){
      $q = $db->prepare('INSERT INTO TagParent(parent, child) VALUES (:parent, :child)');
      $q->execute(array('parent' => $parent, 'child' => $this->id));
    }
  }

  public function delete($user){
    if($user->id != $this->owner){
      return;
    }
    //Also deletes all related TagParent-rows
    $query = DB::connection()->prepare('DELETE FROM Tag WHERE id = :id;');
    $query->execute(array('id' => $this->id));
  }

  public function update($user){
    if($user->id != $this->owner){
      return;
    }
    $db = DB::connection();
    $db->beginTransaction();
    $query = $db->prepare('UPDATE Tag ' .
    'SET name = :name WHERE id = :id');
    $query->execute(array('name' => $this->name, 'id' => $this->id));

    $delquery = $db->prepare('DELETE FROM TagParent WHERE child = :id');
    $delquery->execute(array('id' => $this->id));
    $this->insertParents($db);
    $db->commit();
  }

  public function isParent($tag){
    if(count($this->parentIds) == 0){
      $this->getParents();
    }
    foreach($this->parentIds as $parent){
      if($tag->id == $parent){
        return true;
      }
    }
    return false;
  }

  public function validate_name(){
    return $this->validate_string_max_length($this->name, 50, 'Nimi ei saa olla yli 50 merkkiä pitkä.');
  }
}
