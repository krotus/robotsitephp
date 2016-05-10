<?php 

header('Content-Type: text/html; charset=utf-8');

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
require_once "App/Config/App.php";
require_once "App/Core/Autoload.php";
App\Core\Session::init();
$template = new App\Core\Template();
App\Core\Bootstrap::run(new App\Core\Request());


?>