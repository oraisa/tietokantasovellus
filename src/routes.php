<?php
$routes->get('/', function() {
  //echo "Hello World";
  require("src/views/login.php");
});

$routes->get('/notes', function() {
  require("src/views/notes.php");
});
/*
$routes->get('/note', function() {
  require("src/views/note.php");
});
*/
$routes->get('/newnote', function() {
  require("src/views/newnote.php");
});
