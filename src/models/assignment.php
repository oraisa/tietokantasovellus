<?php
require_once 'src/db.php';
require_once 'src/models/basemodel.php';
class Assignment extends BaseModel{
  public $id, $name, $importance, $deadline, $description, $owner, $tag;

  public function __construct($id, $name, $importance, $deadline, $description, $owner, $tag){
    $this->validators = array("validate_name", "validate_deadline", "validate_importance", "validate_description");
    $this->name = $name;
    $this->id = $id;
    $this->importance = $importance;
    $this->deadline = $deadline;
    $this->description = $description;
    $this->owner = $owner;
    $this->tag = $tag;
  }

  public static function all($user){
    $query = DB::connection()->prepare('SELECT * FROM Assignment WHERE owner = :id');
    $query->execute(array('id' => $user->id));
    $rows = $query->fetchAll();
    $assignments = array();

    foreach($rows as $row){
      $assignments[] = new Assignment($row['id'], $row['name'], $row['importance'],
        $row['deadline'], $row['description'], $row['owner'], $row['tag']);
    }
    return $assignments;
  }

  public static function findById($id){
    $query = DB::connection()->prepare('SELECT * FROM Assignment WHERE Assignment.id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      return new Assignment($row['id'], $row['name'], $row['importance'],
        $row['deadline'], $row['description'], $row['owner'], $row['tag']);
    } else {
      return null;
    }
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Assignment(name, importance, deadline, description, owner, tag)' .
      'VALUES(:name, :importance, :deadline, :description, :owner, :tag) RETURNING id;');
    $query->execute(array('name' => $this->name, 'importance' => $this->importance, 'deadline' => $this->deadline,
      'description' => $this->description, 'owner' => $this->owner, 'tag' => $this->tag));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function delete($user){
    if($user->id != $this->owner){
      return;
    }
    $query = DB::connection()->prepare('DELETE FROM Assignment WHERE id = :id;');
    $query->execute(array('id' => $this->id));
  }

  public function update($user){
    if($user->id != $this->owner){
      return;
    }
    $query = DB::connection()->prepare('UPDATE Assignment ' .
      'SET name = :name, importance = :importance, deadline = :deadline, description = :description ' .
      'WHERE id = :id');
    $query->execute(array('name' => $this->name, 'importance' => $this->importance, 'deadline' => $this->deadline,
      'description' => $this->description, 'id' => $this->id));
  }

  public function validate_name(){
    return $this->validate_string_max_length($this->name, 50, "Nimi ei saa olla yli 50 merkkiä pitkä.");
  }
  public function validate_importance(){
    return $this->validate_is_numeric($this->importance, "Tärkeyden täytyy olla luku.");
  }
  public function validate_description(){
    return $this->validate_string_max_length($this->description, 500, "Kuvaus ei saa olla yli 500 merkkiä pitkä.");
  }
  public function validate_deadline(){
    $errors = array();
    if(!strtotime($this->deadline)){
      $errors[] = "Deadlinin täytyy olla päivämäärä.";
    }
    return $errors;
  }
}
