<?php 

namespace App\Core;

use App\Core\Session as Session;

/**
 * Classe View, te com a objectiu renderitza qualsevol vista que sigui visible per l'estructura de fitxers
 * de l'aplicació. Permet la intrusió de variables entre les diferents vistes per efecetes
 * pràctics de la plataforma.
 * @package \App\Core
 */
class View{

	/**
	 * Metode estàtic to, te com a objectiu renderitza una vista que se li pasi com parametre i en cas de que se li pasi variables
	 * poder-les tractar dintre de la vista renderitzada.
	 * @param string $view Vista a renderitzar.
	 * @param array|null $data Llista de variables a passar a la vista.
	 * @return void
	 */
	public static function to($view, $data = null){

		//carreguem l'idioma que li correspon
		$lang = LOCALE;
		if (Session::get("user") != "") {
			$lang = unserialize(Session::get("user"))->getLanguage()->getCode();
		}
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

	/**
	 * Metode estàtic redirect, el qual te com a objectiu redirigir-nos a una nova vista que se li indiqui.
	 * @param string $view Vista a renderitzar
	 * @param array|null $data Llista de variables a passar a la vista
	 * @return void
	 */
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