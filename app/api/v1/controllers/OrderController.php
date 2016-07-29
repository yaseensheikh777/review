<?php
namespace app\api\v1\controllers;

class OrderController {
	function __construct() {
		
	}

	function postAction() {
		$access_token=$_POST['access_token'];
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
		$model = "app\\models\\repository\\OrderRepository";
		$model=new $model();
		if(isset($_GET['id'])) {
			if(!$data=$model->getOrderById($_GET['id']))
			{
				$data=array('data' => 'No record found');
			}
		}
		else {
			if(isset($_GET['startIdx'])&&isset($_GET['endIdx'])) {
				$startIdx=(int)$_GET['startIdx'];
				$endIdx=(int)$_GET['endIdx'];
				$data=$model->getOrders($startIdx,$endIdx);
			}
		else
			$data=$model->getOrders();	
		}
		echo json_encode($data);
	}

	function deleteAction() {
		print_r($_GET);
		print_r($_POST);
		print_r($_SERVER);
		$model = "app\\models\\repository\\OrderRepository";
		$model=new $model();
		$id=(int)$_GET['id'];
		if($model->getOrderById($id)) {
			$model->deleteOrderById($id);
			echo json_encode(array('status' => 'Order is deleted'));
		}
		else {
			echo json_encode(array('status' => 'No order found'));
		}
	}
}