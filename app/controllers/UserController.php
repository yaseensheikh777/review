<?php

namespace app\controllers;
use app\Routes;
class UserController {
	function __construct() {

	}
	function main()
	{
	}
	function login()
	{
		if(isset($_POST['em'])) {
			$email=$_POST['em'];
			$password=$_POST['pw'];
			$model = "app\\models\\repository\\UserRepository";
			$model=new $model();
			if($role=$model->loginUser($email,$password)) {
				if($role==ROLE_USER) {
					$response['type']=-1;
					$response['message']=HTTP_SERVER."/dashboard";
					$_SESSION['email']=$_POST['email'];
					$_SESSION['role']=$role;
				}
				else {
					$response['type']=-1;
					$response['message']=HTTP_SERVER."/admin/dashboard";
					$_SESSION['email']=$_POST['email'];
					$_SESSION['role']=$role;
				}
			}
			else {
				$response['type']=0;
				$response['message']="Username or Password not valid";
			}
			echo json_encode($response);
			die;
		}
		else 
			Routes::render('userlogin','startup');
	}

	function forgotPassword() 
	{
		routes::render('forgotPassword','startup');
	}

	function resetPassword() 
	{
		routes::render('resetPassword','startup');
	}

}