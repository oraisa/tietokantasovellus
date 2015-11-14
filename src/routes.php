<?php
require(BASE_PATH . '/src/controllers/assignmentcontroller.php');
$routes->get('/', function() {
  require("src/views/login.php");
});

$routes->get('/tehtava/lista', function() {
  AssignmentController::index();
});

$routes->post('/tehtava', function(){
  AssignmentController::store();
});

$routes->get('/tehtava/uusi', function() {
  require("src/views/newassignment.php");
});

$routes->get('/tehtava/:id', function($id){
  AssignmentController::modify($id);
});
