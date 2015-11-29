<?php
require_once 'src/controllers/assignmentcontroller.php';
require_once 'src/controllers/usercontroller.php';
require_once 'src/controllers/tagcontroller.php';
$routes->get('/', function() {
  AssignmentController::index();
});

$routes->get('/login', function() {
  UserController::show_login();
});

$routes->post('/login', function() {
  UserController::login();
});

$routes->post('/logout', function() {
  UserController::logout();
});

$routes->get('/tehtava/lista', function() {
  AssignmentController::index();
});

$routes->get('/tagi/lista', function() {
  TagController::index();
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
