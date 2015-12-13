<?php
require_once('src/models/basemodel.php');
require_once('src/db.php');
class User extends BaseModel {
  public $id, $username, $password;

  public function __construct($id, $username, $password){
    $this->validators = array('validate_password', 'validate_username');

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

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Luser(username, password) VALUES(:username, :password) RETURNING Id');
    $query->execute(array('username' => $this->username, 'password' => $this->password));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function validate_password(){
    return array_merge(
      $this->validate_string_min_length($this->password, 1, "Salasana ei saa olla tyhjä."),
      $this->validate_string_max_length($this->password, 50, "Salasanassa saa olla enitään 50 merkkiä.")
    );
  }

  public function validate_username(){
    $errors = $this->validate_string_max_length($this->username, 50, "Käyttäjänimessä saa olla enintään 50 merkkiä.");
    $query = DB::connection()->prepare('SELECT COUNT(id) count FROM Luser WHERE username = :username');
    $query->execute(array('username' => $this->username));
    $row = $query->fetch();
    if($row['count'] > 0){
      $errors[] = "Käyttäjänimi on jo käytössä.";
    }
    return $errors;
  }
}
