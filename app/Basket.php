<?php
namespace app;

class Basket{

	private static $instance;

	public static function getInstance() {
		if(self::$db)
			return self::$db;
		else
		{
			self::$db = new Basket();
			return self::$db;
		}	
	}

	function set($key,$value)
	{
		//$this->alpha = math
		$this->$key = $value;
	}
	
	function get($key)
	{
		if(isset($this->$key))
			return $this->$key;
		else
			return null;
	}
	

}
?>