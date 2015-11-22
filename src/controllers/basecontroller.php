<?php
class BaseController{
  public static function get_user_logged_in(){
    if(isset($_SESSION['user'])){
      return User::findById($_SESSION['user']);
    } else {
      header('Location: /muistilista/login');
      exit();
    }
  }
}
