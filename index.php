<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require "lib/Slim-2.6.2/Slim/Slim.php";
\Slim\Slim::registerAutoloader();
$routes = new \Slim\Slim();
require "src/routes.php";
$routes->run();
?>
