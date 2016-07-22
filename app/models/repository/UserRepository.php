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
		//print_r($result);die;
		if(sizeof($result)) {
			return $result['roleId'];
		}
		else {
			return false;
		}
	}

}