<?php
namespace app\controllers;
class MainController
{

	function main()
	{
		routes::render('root');
	}
	
	function about()
	{
		routes::render('about');
	}
	
	function contact()
	{
		routes::render('contact');
	}

	function error ()
	{
		echo "Page not found";
	}

}


?>
