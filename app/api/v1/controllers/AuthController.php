<?php

namespace app\api\v1\controllers;

class AuthController {
	
	private $server;
	private $storage;
	
	function __construct() {
		
	}
	function postAction () {
		// global $storage;
		// print_r($storage->checkClientCredentials($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']));
		// $model = "app\\models\\repository\\ApiRepository";
		// $model=new $model();
		// if($access=$model->getAccessTokenDetails($_SERVER['PHP_AUTH_USER'])) {
		// 	print_r($access);die;
		// }
		// else
		// {
		// 	echo "string";
		// 	die;
		// }
		global $server;
		$server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
	}
}