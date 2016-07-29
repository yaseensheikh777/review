<?php
namespace app\controllers;
use app\Routes;
class ReviewController {

	function feedback() {
		if(isset($_POST['title'])) {
			$reviewPage=$_GET['id'];
			$title=$_POST['title'];
			$comment=$_POST['comment'];
			$rate=$_POST['rate'];
			$orderModel = "app\\models\\repository\\OrderRepository";
			$orderModel=new $orderModel();
			if($data=$orderModel->getOrderByReviewPage($reviewPage)) {
				//echo $data->reviewPageStatus;die;
				if($data->reviewPageStatus==REVIEW_URL_STATUS_DEACTIVE) {
					$response['type']=0;
					$response['message']='You have already given the feedback. Thanks';	
				}
				else {
					$reviewCl="app\\models\\Review";
					$review=new $reviewCl();
					$review->rating=$rate;
					$review->title=$title;
					$review->comment=$comment;
					$review->orderId=$data->uoId;
					$model = "app\\models\\repository\\ReviewRepository";
					$model=new $model();
					$model->createReview($review);
					$orderModel->updateReviewPageStatus(REVIEW_URL_STATUS_DEACTIVE,$data->uoId);
					$response['type']=1;
					$response['message']='Thank you for providing the feedback';
				}
			}
			else {
				$response['type']=0;
				$response['message']='The link is not valid';
			}
			echo json_encode($response);
		}
		else
			Routes::render('feedback','startup');
	}
}