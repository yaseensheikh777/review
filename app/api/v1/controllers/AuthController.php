<?php

namespace app\api\v1\controllers;

class AuthController {
	
	private $server;
	private $storage;
	
	function __construct() {
		
	}
	function postAction () {
		global $server;
		$server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
	}
}