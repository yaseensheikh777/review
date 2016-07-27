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
}