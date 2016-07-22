<?php
namespace app;
use app\middlewares\Middleware;
use app\Routes;

class Routes{
	private static $instance = array();
	private $_uri=array();

	function __construct() {
		
	}

	public function add($key,$val) {
		$this->_uri[$key]=$val;
	}
	function set($key,$value) {
		$this->$key = $value;
	}
		
	function get($key) {
		if(isset($this->$key))
			return $this->$key;
		else
			return null;
	}

	function router() {
		$match='/';
		// check if the url parameter is set
		if(isset($_GET['url']))
		{
			// load the url into url variable
			$url = $_GET['url'];
			
			//trim the url to remove slashes on right
			$url = rtrim($url,'/');
			//break the url to fragments
			$url = explode('/',$url);
			$match.=$url[0];
		}
		//require "middlewares".DS."Middleware.php";
		$middleware=new Middleware();

		if($middleware->validate()) {
			// check if first fragment exists
			$alpha='';
			$beta='';
			$is_found=false;
			foreach ($this->_uri as $key => $value) {
				if($key==$match) {
					$uri=explode('@',$value);
					$alpha=$uri[0];
					$beta=$uri[1];
					$is_found=true;
					break;
				}	
			}
			if($is_found) {
				$cl="app\\controllers\\".$alpha;
				$app = new $cl();
				$app->$beta();
			}
			else {
				echo "error";
			}		
		}
		else {
			echo "authentication failed";
		}
	}

	public static function render($view,$tmpl)
	{
		$routes = Routes::getInstance('Routes');
		$routes->set('view',$view);
		require_once "templates".DS.$tmpl.DS."index.php";	
		
	}

	public static function app()
	{
		$routes = Routes::getInstance('Routes');
		$view = $routes->get('view');
		require_once "app".DS."views".DS.$view.DS."default.php";	
	}

	public static function getInstance($class)
	{
		if(isset(self::$instance[$class]))
			return self::$instance[$class];
		else
		{
			$cl='app\\'.$class;
			self::$instance[$class] = new $cl();
			return self::$instance[$class];
		}	
	}
}

?>