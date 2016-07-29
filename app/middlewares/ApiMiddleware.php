<?php

namespace app\middlewares;
require "app/server.php";

class ApiMiddleware {
	function __construct() {
		$this->acl=new Acl();
	}

	public function getDataFromPhpInput() {
		$file = fopen('php://input', 'r');
		$tempName = tempnam('/var/tmp', 'img_');
		$temp = fopen($tempName, 'w');
		$imageSize = stream_copy_to_stream($file, $temp);
		fclose($temp);
		//$imageDimensions = getimagesize($tempName);
		define('tmp',$tempName);
	} 
	public function validate($alpha) {
		global $server;
		if($alpha=="AuthController") {
			return true;
		}
		if($_SERVER['REQUEST_METHOD']=='PUT' || $_SERVER['REQUEST_METHOD']== 'DELETE') {
			$this->getDataFromPhpInput();
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