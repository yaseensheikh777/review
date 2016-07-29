<?php 

namespace app\models\repository;
class ReviewRepository {
	function getReviews($startIdx=0,$limit=0) {
		global $db;
		if(($startIdx==0&&$limit==0)) {
			$query="SELECT * FROM `Review`";	
			$db->query($query);
		}
		else {
			$query="SELECT * FROM `Review` LIMIT :start,:limits";
			$db->query($query);
			$db->bind(':start',$startIdx);
			$db->bind(':limits',$limit);
		}
		$result=$db->resultset();
		$reviewArr=array();
		$reviewCl="app\\models\\Review";
		foreach($result as $rev) {
			$review=new $reviewCl();
			$review->id=$rev['id'];
			$review->rating=$rev['rating'];
			$review->title=$rev['title'];
			$review->comment=$rev['comment'];
			$review->orderId=$rev['orderId'];
			array_push($reviewArr, $review);
		}
		return $reviewArr;
	}

	function getReviewById($id) {
		global $db;
		$query="SELECT * FROM `Review` WHERE id=:id";
		$db->query($query);
		$db->bind(':id',$id);
		$result=$db->single();
		if($result) {
			$reviewCl="app\\models\\Review";
			$review=new $reviewCl();
			$review->id=$result['id'];
			$review->rating=$result['rating'];
			$review->title=$result['title'];
			$review->comment=$result['comment'];
			$review->orderId=$result['orderId'];
			return $review;
		}
		else {
			return false;
		}
		
	}

}