<?php 
require "AutoLoader.php";
use app\Routes;
use app\database\Database;
require "config".DS."config.php";
$db = Database::getInstance();
$routes = Routes::getInstance('Routes');

require "config".DS."routes.php";