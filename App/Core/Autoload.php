<?php 

namespace App\Core;

use App\Utility\Debug as Debug;

require_once "vendor/autoload.php";

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

return Autoload::load();

?>