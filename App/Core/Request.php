<?php 

namespace App\Core;

use App\Core\Session as Session;
use App\Core\View as View;

class Request{

	private $controller;
	private $method;
	private $argument;

	public function __construct(){

		if(!Session::get("lang")){
			Session::set("lang", LOCALE);
		}

		if(isset($_GET["url"])){
			$request = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
			$request = explode("/", $request);
			$request = array_filter($request);
			
						
			$this->controller = strtolower(array_shift($request));
			$this->method = strtolower(array_shift($request));
			if(!$this->method){
				$this->method = "index";
			}
			$this->argument = $request;
		}else{
			$this->controller = FIRST_PAGE;
			$this->method = "index";
		}

		// usuari ha fet login
		if(!Session::isLogged()){
			$pos = strpos($_GET["url"], "login");
			if(is_bool($pos)){
				View::redirect("login.index");	
			}
		}
	}

	public function getController(){
		return $this->controller;
	}

	public function getMethod(){
		return $this->method;
	}

	public function getArgument(){
		return $this->argument;
	}

}

?>