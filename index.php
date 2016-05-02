<?php 

header('Content-Type: text/html; charset=utf-8');

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__FILE__)) . DS);
define("URL", "http://localhost/api.web.com/");

require_once "App/Core/Autoload.php";

App\Core\Autoload::load();
$template = new App\Core\Template();
App\Core\Bootstrap::run(new App\Core\Request());




?>