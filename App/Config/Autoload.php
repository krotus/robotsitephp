<?php 

namespace App\Config;

class Autoload{

	public static function load(){
		spl_autoload_register(function($class){
			$route = str_replace("\\", "/", $class) . ".php";
			if(is_readable($route)){
				include_once $route;
			}
		});
	}

}


?>