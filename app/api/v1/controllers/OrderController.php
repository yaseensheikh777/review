<?php
namespace app\api\v1\controllers;

class OrderController {
	function __construct() {
		
	}

	function postAction() {
		$model = "app\\models\\repository\\OrderRepository";
		$model=new $model();
		$model->getOrders(0,10);
		die;
	}

	function getAction() {
		echo "abcddd";
		die;
	}
}