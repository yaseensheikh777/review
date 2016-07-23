<?php 
require "AutoLoader.php";
session_start();
//print_r($_SESSION['email']);
use app\Routes;
use app\database\Database;
require "config".DS."config.php";
$db = Database::getInstance();
$routes = Routes::getInstance('Routes');

require "config".DS."routes.php";