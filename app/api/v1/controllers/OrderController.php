<?php
namespace app\api\v1\controllers;

class OrderController {
	function __construct() {
		
	}

	function postAction() {
		foreach (getallheaders() as $name => $value) {
		    if($name=='Authorization') {
		    	$auth=$value;
		    }
		}
		$auth=explode(' ',$auth);
		$access_token=trim($auth[1]);
		$orderCl="app\\models\\Order";
		$order=new $orderCl();
		$order->id=(int) $_POST['id'];
		$apiModel = "app\\models\\repository\\ApiRepository";
		$apiModel=new $apiModel();
		$order->userId=$apiModel->getUserIdByToken($access_token);
		$order->creationTime=date("Y-m-d H:i:s");
		$order->status=ORDER_STATUS_ACTIVE;
		$order->reviewPage=md5($order->id.$order->userId.$order->creationTime);
		$order->reviewPageStatus=REVIEW_URL_STATUS_ACTIVE;
		$model = "app\\models\\repository\\OrderRepository";
		$model=new $model();
		$model->createOrder($order);
		echo json_encode(array('link' => HTTP_SERVER.'/feedback?id='.$order->reviewPage ));
	}

	function getAction() {
		foreach (getallheaders() as $name => $value) {
		    if($name=='Authorization') {
		    	$auth=$value;
		    }
		}
		$auth=explode(' ',$auth);
		$access_token=trim($auth[1]);
		$apiModel = "app\\models\\repository\\ApiRepository";
		$apiModel=new $apiModel();
		$userId=$apiModel->getUserIdByToken($access_token);
		$model = "app\\models\\repository\\OrderRepository";
		$model=new $model();
		if(isset($_GET['id'])) {
			if(!$data=$model->getOrderById($_GET['id'],$userId))
			{
				$data=array('data' => 'No record found');
			}
		}
		else {
			if(isset($_GET['startIdx'])&&isset($_GET['endIdx'])) {
				$startIdx=(int)$_GET['startIdx'];
				$endIdx=(int)$_GET['endIdx'];
				$data=$model->getOrders($userId,$startIdx,$endIdx);
			}
		else
			$data=$model->getOrders($userId);	
		}
		echo json_encode($data);
	}

	function deleteAction() {
		if(isset($_GET['id'])) {
			$id=(int)$_GET['id'];
		}
		else {
			echo json_encode(array('status' => 'No id provided'));
			die;
		}
		foreach (getallheaders() as $name => $value) {
		    if($name=='Authorization') {
		    	$auth=$value;
		    }
		}
		$auth=explode(' ',$auth);
		$access_token=trim($auth[1]);
		$apiModel = "app\\models\\repository\\ApiRepository";
		$apiModel=new $apiModel();
		$userId=$apiModel->getUserIdByToken($access_token);
		$model = "app\\models\\repository\\OrderRepository";
		$model=new $model();
		if($model->getOrderById($id,$userId)) {
			$model->deleteOrderById($id,$userId);
			echo json_encode(array('status' => 'Order is deleted'));
		}
		else {
			echo json_encode(array('status' => 'No order found'));
		}
	}
}