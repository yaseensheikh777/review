<?php
namespace app\api\v1\controllers;

class ReviewController {
	function __construct() {

	}
	
	function getAction() {
		$apiModel = "app\\models\\repository\\ApiRepository";
		$apiModel=new $apiModel();
		foreach (getallheaders() as $name => $value) {
		    if($name=='Authorization') {
		    	$auth=$value;
		    }
		}
		$auth=explode(' ',$auth);
		$access_token=trim($auth[1]);
		$userId=$apiModel->getUserIdByToken($access_token);
		$model = "app\\models\\repository\\ReviewRepository";
		$model=new $model();
		if(isset($_GET['orderId'])) {
			$id=$_GET['orderId'];
			$data=$model->getReviewsOfUserByOrderId($id,$userId);
		}
		else {
			if(isset($_GET['startIdx'])&&isset($_GET['endIdx'])) {
				$start=(int) $_GET['startIdx'];
				$end=(int) $_GET['endIdx'];
				$data=$model->getReviewsOfUser($userId,$start,$end);
			}
			else {
				$data=$model->getReviewsOfUser($userId);
			}
		}
		if(!$data) {
				$data = array('message' =>  'No review Found');
		}
		echo json_encode($data);
	}

	function putAction() {

		print_r(file_get_contents(tmp));
		echo "string";die;
	}
}