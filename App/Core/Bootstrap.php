<?php 

namespace App\Core;

class Bootstrap{

	public static function run(Request $request){
		$controller = ucfirst($request->getController()) . "Controller";
		$route = ROOT . "Controllers" . DS . ucfirst($request->getController()) . DS . $controller . ".php";
		$method = $request->getMethod();
		if($method == "index.php"){
			$method = "index";
		}
		$argument = $request->getArgument();

		if(is_readable($route)){
			require_once $route;
			$namespaceController = "Controllers\\" . ucfirst($request->getController()) . "\\" . $controller;
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
		}
	}
}


?>