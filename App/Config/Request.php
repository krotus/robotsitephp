<?php 

namespace App\Config;

class Request{

	private $controller;
	private $method;
	private $argument;

	public function __construct(){
		if(isset($_GET["url"])){
			$request = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
			$request = explode("/", $request);
			$request = array_filter($request);

			if($request[0] == "index.php"){
				$this->controller = "worker";
			}else{
				$this->controller = strtolower(array_shift($request));
			}

			$this->method = strtolower(array_shift($request));
			if(!$this->method){
				$this->method = "index";
			}
			$this->argument = $request;
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