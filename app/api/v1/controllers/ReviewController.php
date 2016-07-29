<?php
namespace app\api\v1\controllers;

class ReviewController {
	function __construct() {

	}
	
	function getAction() {
		$apiModel = "app\\models\\repository\\ApiRepository";
		$apiModel=new $apiModel();
		$model = "app\\models\\repository\\ReviewRepository";
		$model=new $model();
		if(isset($_GET['orderId'])) {
			$id=$_GET['orderId'];
			if(!$data=$model->getReviewByOrderId($id,$userId)) {
				$data=array('data' => 'No record found');
			}
		}
		else {
			$data=$model->getReviews();
		}
		echo json_encode($data);
	}

	function putAction() {

		print_r(file_get_contents(tmp));
		echo "string";die;
	}
}