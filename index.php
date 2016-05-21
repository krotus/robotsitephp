<?php 

header('Content-Type: text/html; charset=utf-8');

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
require_once "App/Config/App.php";
require_once "App/Core/Autoload.php";
App\Core\Session::init();
if(App\Core\Session::get("user")){
	if(unserialize(App\Core\Session::get("user")) instanceof Models\Business\Worker){
		$template = new App\Core\WorkerTemplate();
	}else{
		$template = new App\Core\AdminTemplate();
	}
}else{
	$template = new App\Core\LoginTemplate();
}
App\Core\Bootstrap::run(new App\Core\Request());


?>