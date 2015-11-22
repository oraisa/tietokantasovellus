<?php
require(BASE_PATH . '/src/controllers/assignmentcontroller.php');
require(BASE_PATH . '/src/controllers/usercontroller.php');
$routes->get('/', function() {
  AssignmentController::index();
});

$routes->get('/login', function() {
  UserController::show_login();
});

$routes->post('/login', function() {
  UserController::login();
});

$routes->get('/tehtava/lista', function() {
  AssignmentController::index();
});

$routes->post('/tehtava', function(){
  AssignmentController::store();
});

$routes->get('/tehtava/uusi', function() {
  AssignmentController::new_assignment();
});

$routes->post('/tehtava/:id/paivita', function($id){
  AssignmentController::update($id);
});

$routes->post('/tehtava/:id/poista', function($id){
  AssignmentController::delete($id);
});

$routes->get('/tehtava/:id', function($id){
  AssignmentController::modify($id);
});
