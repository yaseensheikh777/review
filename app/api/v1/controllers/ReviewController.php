<?php
namespace app\api\v1\controllers;

class ReviewController {
	function __construct() {

	}
	
	function getAction() {
		$model = "app\\models\\repository\\ReviewRepository";
		$model=new $model();
		if(isset($_GET['id'])) {
			$id=$_GET['id'];
			if(!$data=$model->getReviewById($id)) {
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