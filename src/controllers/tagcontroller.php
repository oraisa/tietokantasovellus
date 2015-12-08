<?php
require_once 'src/controllers/basecontroller.php';
class TagController extends BaseController {

  public static function index(){
    $user = self::get_user_logged_in();
    $tags = Tag::all($user);
    include 'src/views/tags.php';
  }

  public static function store(){
    $user = self::get_user_logged_in();
    $params = $_POST;
    $tag = new Tag(-1, $params['name'], $user->id);
    $errors = $tag->validate();
    if(count($errors) == 0){
      $tag->save();
      header('Location: /muistilista/tagi/lista');
      exit();
    } else {
      include 'src/views/tags.php';
    }
  }

  public static function update($id){
    $user = self::get_user_logged_in();
    $params = $_POST;
    $assignment = new Tag($id, $params['name'], $user->id);
    $errors = $assignment->validate();
    if(count($errors) == 0){
      $assignment->update($user);
      header('Location: /muistilista/tagi/lista');
      exit();
    } else {
      include('src/views/tags.php');
    }
  }

  public static function delete($id){
    $user = self::get_user_logged_in();
    Tag::findById($id)->delete($user);
    header('Location: /muistilista/tagi/lista');
    exit();
  }
}
