<?php

namespace app\models\repository;
class ApiRepository {

	function getAccessTokenDetails($clientId) {
		global $db;
		$query="SELECT * FROM oauth_access_tokens WHERE client_id=:client";
		$db->query($query);
		$db->bind(':client',$clientId);
		$result=$db->single();
		if(sizeof($result)) {
			return $result;
		}
		else {
			return false;
		}
	}

	function getUserIdByToken($access_token) {
		global $db;
		$query="SELECT user_id FROM oauth_access_tokens WHERE access_token=:access_token";
		$db->query($query);
		$db->bind(':access_token',$access_token);
		$result=$db->single();
		if(sizeof($result)) {
			return $result['user_id'];
		}
		else {
			return false;
		}
	}
}