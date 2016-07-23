<?php

namespace app\middlewares;
use app\middlewares\Acl;

class Middleware {
	private $acl;

	function __construct() {
		$this->acl=new Acl();
	}

	public function validate() {
		return $this->acl->isAllowed();
	}
}