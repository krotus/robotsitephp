<?php 

header('Content-Type: text/html; charset=utf-8');

//importem sobre constants que utilitza l'aplicació
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
require_once "App/Config/App.php";
require_once "App/Core/Autoload.php";
App\Core\Session::init();
//segons el tipus d'usuari la plantilla sera diferent en cada cas
if(App\Core\Session::get("user")){
	if(unserialize(App\Core\Session::get("user")) instanceof Models\Business\Worker){
		$template = new App\Core\WorkerTemplate();
	}else{
		$template = new App\Core\AdminTemplate();
	}
}else{
	$template = new App\Core\LoginTemplate();
}
//escoltem sobre la petició del client
App\Core\Bootstrap::run(new App\Core\Request());


?>