<?php 

namespace App\Core;

class View{

	public static function to($view, $data){
		//load de la vista
		$view = str_replace(".", "/", $view);
		$view = ROOT . "Views/" . $view . ".php";
		if(is_readable($view)){
			require_once $view;
		}else{
			echo "La vista no es troba";
		}
	}

	public static function redirectTo(){

	}
}

?>