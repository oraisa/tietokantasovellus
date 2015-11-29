<?php
require_once('src/models/user.php');
require_once('src/controllers/basecontroller.php');
class UserController extends BaseController{

  public static function login(){
    $params = $_POST;
    $user = User::authenticate($params['username'], $params['password']);
    if(!$user){
      $error = 'Väärä käyttäjätunnus tai salasana.';
      $username = $params['username'];
      include BASE_PATH . '/src/views/login.php';
    } else {
      $_SESSION['user'] = $user->id;
      header('Location: ' . '/muistilista/tehtava/lista');
      exit();
    }
  }

  public static function show_login(){
    $error = '';
    $username = '';
    include BASE_PATH . '/src/views/login.php';
  }

  public static function logout(){
    $_SESSION['user'] = null;
    header('Location: /muistilista/login');
    exit();
  }
}
