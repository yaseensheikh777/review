<?php
namespace app\models\repository;
class UserRepository {

	function loginUser($email,$password) {
		$query="SELECT roleId FROM User WHERE email=:email AND password=:pass ";
		global $db;
		$db->query($query);
		$db->bind(':email',$email);
		$db->bind(':pass',$password);
		$result=$db->single();
		if(sizeof($result)) {
			return $result['roleId'];
		}
		else {
			return false;
		}
	}

	function isEmailExist($email) {
		global $db;
		$query="SELECT id FROM User WHERE email=:email ";
		$db->query($query);
		$db->bind(':email',$email);
		$result=$db->single();
		if(sizeof($result)) {
			return $result['id'];
		}
		else 
			return false;
	}


	function updateForgottenPasswordCode($id,$encryptId='') {
		global $db;
		$query="UPDATE User SET forgotPasswordCode=:code WHERE id=:id";
		$db->query($query);
		$db->bind(':code',$encryptId);
		$db->bind(':id',$id);
		$db->execute();
	}

	function updatePassword($id,$password) {
		global $db;
		$query="UPDATE User SET password=:password WHERE id=:id";
		$db->query($query);
		$db->bind(':password',$password);
		$db->bind(':id',$id);
		$db->execute();
	}

	function isForgotPasswordCodeValid($encryptedCode) {
		global $db;
		$query="SELECT id FROM User WHERE forgotPasswordCode=:encryptedCode";
		$db->query($query);
		$db->bind(':encryptedCode',$encryptedCode);
		$result=$db->single();
		if(sizeof($result)) {
			return $result['id'];
		}
		else 
			return false;
	}

	function getCustomersList($role=ROLE_USER) {
		global $db;
		$query="SELECT * FROM User WHERE role=:role";
		$db->query($query);
		$db->bind(':role',$role);
		$result=$db->resultset();
		$user='app\\models\\User';
		$users=array();
		foreach ($result as $value) {
			$user_obj=new $user();
			$user_obj->id=
			print_r($value);
		}
		die;
	}

	
}