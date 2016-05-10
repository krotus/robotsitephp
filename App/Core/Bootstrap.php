<?php 

namespace App\Core;

use App\Core\Session as Session;
use App\Utility\Debug as Debug;

class Bootstrap{

	public static function run(Request $request){
		$controller = ucfirst($request->getController()) . "Controller";
		if($request->getPage() == "admin"){
			$route = ROOT . "Controllers" . DS . "Admin" . DS . $controller . ".php";
		}else{
			$route = ROOT . "Controllers" . DS . ucfirst($request->getController()) . DS . $controller . ".php";
		}
		$method = $request->getMethod();
		if($method == "index.php"){
			$method = "index";
		}
		$argument = $request->getArgument();
		if(is_readable($route)){
			require_once $route;
			if($request->getPage() == "admin"){
				$namespaceController = "Controllers\\Admin\\" . $controller;
			}else{
				$namespaceController = "Controllers\\" . ucfirst($request->getController()) . "\\" . $controller;
			}
			$controller = new $namespaceController;
			$methodsClass = get_class_methods($controller);

			if(in_array($method, $methodsClass)){
				if(!isset($argument)){
					// Retornem els valors $data a la view 
					call_user_func(array($controller, $method));
				}else{
					call_user_func_array(array($controller, $method), $argument);
				}
			}else{
				echo "error 404";
			}
		}else{
			echo "error 404 no route found.";
		}
	}
}


?>