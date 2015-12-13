<?php
require_once 'src/models/user.php';
require_once 'src/controllers/basecontroller.php';
class UserController extends BaseController{

  public static function login(){
    $params = $_POST;
    $user = User::authenticate($params['username'], $params['password']);
    if(!$user){
      $error = 'Väärä käyttäjätunnus tai salasana.';
      $username = $params['username'];
      include 'src/views/login.php';
    } else {
      $_SESSION['user'] = $user->id;
      header('Location: /muistilista/tehtava/lista');
      exit();
    }
  }

  public static function show_login(){
    $error = '';
    $username = '';
    include 'src/views/login.php';
  }

  public static function logout(){
    $_SESSION['user'] = null;
    header('Location: /muistilista/login');
    exit();
  }

  public static function show_register(){
    $user = new User(-1, '', '');
    include 'src/views/register.php';
  }

  public static function register(){
    $params = $_POST;
    $user = new User(-1, $params['username'], $params['password']);
    $errors = $user->validate();
    if($params['password'] != $params['passwordConfirm']){
      $errors[] = 'Salasanat eivät täsmää.';
    }
    if(count($errors) == 0){
      $user->save();
      self::login();
    } else {
      include 'src/views/register.php';
    }
  }
}
