<?php

require "Acl.php";
class Middleware {
	private $acl;
	public function middleware() {
		session_start();
		$this->acl=new ACL();
	}

	public function validate() {
		return $this->acl->isAllowed();
	}
}