<?php 

namespace App\Core;

use App\Core\Session as Session;
use App\Core\View as View;
use Models\Business\User as User;
use Models\Business\Worker as Worker;

/**
 * Classe Request, utilitzada per gestionar les diferents peticions del client sobre l'aplicació.
 * @package \App\Core
 */
class Request{

	//metodes privats
	private $page;
	private $controller;
	private $method;
	private $argument;

	//Construcció de la petició de control
	public function __construct(){

		// usuari no ha fet login
		if(!Session::isLogged()){
			$pos = strpos($_GET["url"], "login");
			if(is_bool($pos)){
				$alert = "Por favor, primero debes iniciar sessión.";
				View::redirect("login.index", compact('alert'));
				exit;
			}
		}else{ //usuari ha fet login
			if(isset($_GET["url"])){
				$pos = strpos($_GET["url"], "login");
				if(!is_bool($pos)){
					//mode multi idioma => clau associativa del array de langs
					$alert = "Ya has iniciado iniciado sessión con tu cuenta!";
					View::redirect("", compact('alert'));	
					exit;
				}
			}
		}

		if(isset($_GET["url"])){
			$request = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
			$request = explode("/", $request);
			$request = array_filter($request);

			$isAdminPage = in_array("admin", $request);
			if($isAdminPage){ //peticio a una pagina admin
				if(unserialize(Session::get("user")) instanceof Worker){ //si ets un treballador redireccionem a la primera pagina
					$alert = "No tienes acceso a esa pagina!";
					View::redirect(FIRST_PAGE, compact('alert'));
					exit;
				}else{
					$this->page = strtolower(array_shift($request)); //retallem /admin
				}
			}
			if(count($request) == 0){
				$this->controller = FIRST_PAGE_ADMIN;
			}else{
				$this->controller = strtolower(array_shift($request));
				$this->method = array_shift($request);
			}
			if(!$this->method){
				$this->method = "index";
			}
			$this->argument = $request;
		}else{
			$this->controller = FIRST_PAGE;
			$this->method = "index";
		}
	}

	public function getPage(){
		return $this->page;
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