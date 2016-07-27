<?php

namespace app\middlewares;
require "app/server.php";

class ApiMiddleware {
	function __construct() {
		$this->acl=new Acl();
	}

	public function validate($alpha) {
		global $server;
		if($alpha=="AuthController") {
			return true;
		}
		// Handle a request to a resource and authenticate the access token
		if (!$server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
		    $server->getResponse()->send();
		    return false;
		}
		else {
			return true;
		}
	}
}