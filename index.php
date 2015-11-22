<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('BASE_PATH', __DIR__);

if(session_id() == '') {
  session_start();
}

require_once "lib/Slim-2.6.2/Slim/Slim.php";
\Slim\Slim::registerAutoloader();
$routes = new \Slim\Slim();
require_once "src/routes.php";
$routes->run();
?>
