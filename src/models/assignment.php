<?php
require_once 'src/db.php';
class Assignment {
  public $id, $name, $importance, $deadline, $description, $owner, $tag;

  public function __construct($id, $name, $importance, $deadline, $description, $owner, $tag){
    $this->name = $name;
    $this->id = $id;
    $this->importance = $importance;
    $this->deadline = $deadline;
    $this->description = $description;
    $this->owner = $owner;
    $this->tag = $tag;
  }

  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Assignment');
    $query->execute();
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
}
