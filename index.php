<?php 

header('Content-Type: text/html; charset=utf-8');

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);

require_once "App/Config/Autoload.php";

App\Config\Autoload::load();
App\Config\Bootstrap::run(new App\Config\Request());



?>