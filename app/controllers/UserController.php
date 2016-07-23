<?php

namespace app\controllers;
use app\Routes;
use app\helpers\Helper;

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
					$_SESSION['email']=$email;
					$_SESSION['role']=$role;
				}
				else {
					$response['type']=-1;
					$response['message']=HTTP_SERVER."/admin/dashboard";
					$_SESSION['email']=$email;
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
		if(isset($_POST['em'])) {
			$email=$_POST['em'];
			$model = "app\\models\\repository\\UserRepository";
			$model=new $model();
			if($id=$model->isEmailExist($email)) {
				$encryptId=crypt($id.$email.rand());
				$model->updateForgottenPasswordCode($id,$encryptId);
				$link=HTTP_SERVER.'/reset-password?id='.$encryptId;
				$message="Please click on this link to reset your password ".$link;
				mail($email, 'Reset Password', $message);
				$response['type']=1;
				$response['message']='We have sent you an email with instructions to reset your password';
			}
			else {
				$response['type']=0;
				$response['message']='The email does not exist. Please make sure the email is correct';
			}
			echo json_encode($response);
			die;
		}
		else 
			routes::render('forgotPassword','startup');
	}

	function resetPassword() 
	{
		if(isset($_POST['pw1'])) {
			$password=$_POST['pw1'];
			$encryptedCode=$_GET['id'];
			$model = "app\\models\\repository\\UserRepository";
			$model=new $model();
			if($id=$model->isForgotPasswordCodeValid($encryptedCode)) {
				$model->updatePassword($id,$password);
				$model->updateForgottenPasswordCode($id);
				$response['type']=1;
				$response['message']='Your password has been reset. <a href="login" >Click here</a> to login';
			}
			else {
				$response['type']=0;
				$response['message']='Please make sure the link is correct';
			}
			echo json_encode($response);
			die;
		}
		else if(isset($_GET['id'])) 
			Routes::render('resetPassword','startup');
		else {
			echo "You don't have permission to access this page";
		}
	}


	function adminDashboard() {
		$model = "app\\models\\repository\\UserRepository";
		$model=new $model();
		$list=$model->getCustomersList();
		Routes::render('adminDashboard','startup');
	}

}