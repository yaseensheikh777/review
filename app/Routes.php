<?php

class Routes{
	private static $instance = array();
	private $_uri=array();

	public function Routes() {
		// $this->add('/','Users@login');
		// $this->add('/login','Users@login');
		//$this->add('/contact');
	}

	public function add($key,$val) {
		$this->_uri[$key]=$val;
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

	function router()
		{
			//print_r($this->_uri);die;
			// check if the url parameter is set
			if(isset($_GET['url']))
			{
				// load the url into url variable
				$url = $_GET['url'];
				
				//trim the url to remove slashes on right
				$url = rtrim($url,'/');
				//break the url to fragments
				$url = explode('/',$url);
			}
			
			require "middlewares".DS."Middleware.php";
			$middleware=new middleware();

			if($middleware->validate()) {
				// check if first fragment exists
				$alpha='';
				$beta='';
				$match='/'.$url[0];
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
					$file = "app".DS."controllers".DS.$alpha.".php";
					require_once $file;
					$app = new $alpha();
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

		public static function render($view)
		{
			$routes = Routes::getInstance('Routes');
			$routes->set('view',$view);
			$tmpl="startup";
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
				// if($class=='pdo') {
				// 	try {
				// 		self::$instance[$class] = new PDO("mysql:host=localhost;dbname=test_db", 'root', '');
				// 		//echo "connection";
				// 	}
				// 	catch(PDOException $e) {
				// 		print_r($e);
				// 	}
				// }
				// else {
				if(!class_exists($class))
					self::autoload($class);	
				self::$instance[$class] = new $class();
				//}
				return self::$instance[$class];
			}	
		}

		private static function autoload($class)
		{
			$paths = array('lib','app'.DS.'controllers','app'.DS.'models','app','app'.DS.'database');
			foreach($paths as $path)
			{
				$file = $path.DS.$class.'.php';
				if(file_exists($file))
					require_once $file;
			}
		}

		public static function getModel($model)
		{
			$file = "app".DS."models".DS.$model.".php";
			if(file_exists($file))
			{
				require_once $file;
				$model_obj = new $model();
				return $model_obj;
			}
			else
				echo "model doesnt exists";
				
		}

}

?>