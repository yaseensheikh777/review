<?php 

namespace app\models\repository;
class ReviewRepository {
	function getReviewsOfUser($userId,$startIdx=0,$limit=0) {
		global $db;
		if(($startIdx==0&&$limit==0)) {
			$query="SELECT r.*,o.id as oId FROM `Review` r JOIN `Order` o ON o.uoid=r.orderId WHERE o.userId=:userId";	
			$db->query($query);
		}
		else {
			$query="SELECT r.*,o.id as oId FROM `Review` r JOIN `Order` o ON o.uoid=r.orderId WHERE o.userId=:userId LIMIT :start,:limits";
			$db->query($query);
			$db->bind(':start',$startIdx);
			$db->bind(':limits',$limit);
		}
		$db->bind(':userId',$userId);
		$result=$db->resultset();
		$reviewArr=array();
		$reviewCl="app\\models\\Review";
		foreach($result as $rev) {
			$review=new $reviewCl();
			$review->id=$rev['id'];
			$review->rating=$rev['rating'];
			$review->title=$rev['title'];
			$review->comment=$rev['comment'];
			$review->orderId=$rev['oId'];
			array_push($reviewArr, $review);
		}
		return $reviewArr;
	}

	function getReviewsOfUserByOrderId($id,$userId) {
		global $db;
		$query="SELECT r.* FROM `Review` r JOIN `Order` o ON o.uoid=r.orderId WHERE o.userId=:userId AND o.Id=:id";
		$db->query($query);
		$db->bind(':id',$id);
		$db->bind(':userId',$userId);
		$result=$db->single();
		if($result) {
			$reviewCl="app\\models\\Review";
			$review=new $reviewCl();
			$review->id=$result['id'];
			$review->rating=$result['rating'];
			$review->title=$result['title'];
			$review->comment=$result['comment'];
			$review->orderId=$id;
			return $review;
		}
		else {
			return false;
		}
		
	}

	function createReview($review) {
		global $db;
		$query="INSERT INTO `Review` VALUES(NULL,:rating,:title,:comment,:orderId)";
		$db->query($query);
		$db->bind(':rating',$review->rating);
		$db->bind(':title',$review->title);
		$db->bind(':comment',$review->comment);
		$db->bind(':orderId',$review->orderId);
		$db->execute();
	}
	

}