<?php 

namespace App\Core;

use App\Core\Session as Session;

class View{

	public static function to($view, $data = null){

		//carreguem l'idioma que li correspon
		$lang = Session::get("lang");
		$choiceLang = ROOT . "Resources/Lang/" . $lang .".php";
		$trans = include $choiceLang;

		//renderitzem la vista
		$view = str_replace(".", "/", $view);
		$view = ROOT . "Views/" . $view . ".php";
		if(is_readable($view)){
			if(Session::get("parameters")){
				$parameters = Session::get("parameters");
				foreach ($parameters as $key => $value) {
					$data[$key] = $value;
				}
			}
			require_once $view;
			Session::destroy("parameters");
		}else{
			echo "La vista no es troba";
		}
	}

	public static function redirect($view, $data = null){
		$view = str_replace(".", "/", $view);
		$view = URL . $view;
		if($data){
			Session::set("parameters", $data);
		}
		header("location:" . $view );
		
	}

}

?>