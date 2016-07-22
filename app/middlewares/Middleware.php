<?php

namespace app\middlewares;
use app\middlewares\Acl;

class Middleware {
	private $acl;

	function __construct() {
		session_start();
		$this->acl=new Acl();
	}

	public function validate() {
		return $this->acl->isAllowed();
	}
}