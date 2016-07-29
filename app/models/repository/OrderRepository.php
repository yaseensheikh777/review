<?php

namespace app\models\repository;
class OrderRepository {
	function getOrders($startIdx=0,$limit=0) {
		global $db;
		if(($startIdx==0&&$limit==0)) {
			$query="SELECT * FROM `Order` WHERE status=".ORDER_STATUS_ACTIVE;	
			$db->query($query);
		}
		else {
			$query="SELECT * FROM `Order` WHERE status=".ORDER_STATUS_ACTIVE." LIMIT :start,:limits";
			$db->query($query);
			$db->bind(':start',$startIdx);
			$db->bind(':limits',$limit);
			
		}
		$result=$db->resultset();
		$orderArr=array();
		$orderCl="app\\models\\Order";
		foreach($result as $ord) {
			$order=new $orderCl();
			$order->id=$ord['id'];
			$order->userId=$ord['userId'];
			$order->creationTime=$ord['creationTime'];
			$order->status=$ord['status'];
			array_push($orderArr, $order);
		}
		return $orderArr;
	}

	function getOrderById($id) {
		global $db;
		$query="SELECT * FROM `Order` WHERE id=:id AND status=".ORDER_STATUS_ACTIVE;
		$db->query($query);
		$db->bind(':id',$id);
		$result=$db->single();
		if($result) {
			$orderCl="app\\models\\Order";
			$order=new $orderCl();
			$order->id=$result['id'];
			$order->userId=$result['userId'];
			$order->creationTime=$result['creationTime'];
			$order->status=$result['status'];
			return $order;
		}
		else {
			return false;
		}
		
	}

	function deleteOrderById($id) {
		global $db;
		//$query="DELETE FROM `Order` WHERE id=:id";
		$query="UPDATE `Order` SET status=".ORDER_STATUS_DEACTIVE." WHERE id=:id";
		$db->query($query);
		$db->bind(':id',$id);
		$db->execute();
	}

	function createOrder($order) {
		global $db;
		$query="INSERT INTO `Order` VALUES(:id,:userId,:creationTime,:status,:reviewPage,:reviewPageStatus)";
		$db->query($query);
		$db->bind(':id',$order->id);
		$db->bind(':userId',$order->userId);
		$db->bind(':creationTime',$order->creationTime);
		$db->bind(':status',$order->status);
		$db->bind(':reviewPage',$order->reviewPage);
		$db->bind(':reviewPageStatus',$order->reviewPageStatus);
		$db->execute();
	}
}