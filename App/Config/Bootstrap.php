<?php 

namespace App\Config;

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
			if(!isset($argument)){
				call_user_func(array($controller, $method));
			}else{
				call_user_func_array(array($controller, $method), $argument);
			}
		}
	}
}


?>