<?php 


require "config".DS."config.php";
require "database".DS."Database.php";
require "Routes.php";


$db = Routes::getInstance('Database');
$routes = Routes::getInstance('Routes');

require "config".DS."definedRoutes.php";