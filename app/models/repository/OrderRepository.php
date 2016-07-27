<?php

namespace app\models\repository;
class OrderRepository {
	function getOrders($startIdx,$limit) {
		global $db;
		$query="SELECT * FROM `Order` LIMIT :start,:limits";
		$db->query($query);
		$db->bind(':start',$startIdx);
		$query=$db->bind(':limits',$limit);
		//echo $query."asdas";die;
		$result=$db->resultset();
		print_r($result);
	}
}