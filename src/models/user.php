<?php
require_once('src/models/basemodel.php');
require_once('src/db.php');
class User extends BaseModel {
  public $id, $username, $password;

  public function __construct($id, $username, $password){
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
  }

  public static function authenticate($username, $password){
    $query = DB::connection()->prepare('SELECT * FROM Luser WHERE username = :username AND password = :password LIMIT 1');
    $query->execute(array('username' => $username, 'password' => $password));
    $row = $query->fetch();
    if($row){
      return new User($row['id'], $row['username'], $row['password']);
    } else {
      return null;
    }
  }

  public static function findById($id){
    $query = DB::connection()->prepare('SELECT * FROM Luser WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();
    return new User($row['id'], $row['username'], $row['password']);
  }
}
