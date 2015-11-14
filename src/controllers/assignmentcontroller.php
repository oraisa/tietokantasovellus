<?php
require_once(BASE_PATH . '/src/models/assignment.php');
class AssignmentController {
  public static function index(){
    $assignments = Assignment::all();
    include(BASE_PATH . '/src/views/assignments.php');
  }

  public static function modify($id){
    $assignment = Assignment::findById($id);
    include(BASE_PATH . '/src/views/modifyassignment.php');
  }

  public static function store(){
    $params = $_POST;
    $assignment = new Assignment(-1, $params['name'], $params['importance'],
      $params['deadline'], $params['description'], 1/*owner*/, $params['tag']);
    $assignment->save();

    header('Location: ' . '/muistilista/tehtava/lista');
    exit();
  }
}
