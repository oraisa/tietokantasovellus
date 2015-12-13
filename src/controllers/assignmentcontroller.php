<?php
require_once('src/models/assignment.php');
require_once('src/controllers/basecontroller.php');
class AssignmentController extends BaseController{
  public static function index(){
    $user = self::get_user_logged_in();
    $assignments = Assignment::all($user);
    include('src/views/assignments.php');
  }

  public static function new_assignment(){
    $user = self::get_user_logged_in();
    $assignment = new Assignment(-1, '', '', '', '', -1, 1);
    include('src/views/newassignment.php');
  }

  public static function modify($id){
    $user = self::get_user_logged_in();
    $assignment = Assignment::findById($id);
    include('src/views/modifyassignment.php');
  }

  public static function store(){
    $user = self::get_user_logged_in();
    $params = $_POST;
    $assignment = new Assignment(-1, $params['name'], $params['importance'],
    $params['deadline'], $params['description'], $user->id, $params['tag']);
    $errors = $assignment->validate();
    if(count($errors) == 0){
      $assignment->save();
      header('Location: /muistilista/tehtava/lista');
      exit();
    } else {
      include('src/views/modifyassignment.php');
    }
  }

  public static function update($id){
    $user = self::get_user_logged_in();
    $params = $_POST;
    $assignment = new Assignment($id, $params['name'], $params['importance'],
    $params['deadline'], $params['description'], $user->id, $params['tag']);
    $errors = $assignment->validate();
    if(count($errors) == 0){
      $assignment->update($user);
      header('Location: /muistilista/tehtava/lista');
      exit();
    } else {
      include('src/views/modifyassignment.php');
    }
  }

  public static function delete($id){
    $user = self::get_user_logged_in();
    Assignment::findById($id)->delete($user);
    header('Location: /muistilista/tehtava/lista');
    exit();
  }
}
