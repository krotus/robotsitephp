<?php 

namespace App\Core;

use App\Utility\Debug as Debug;

require_once "vendor/autoload.php";

/**
 * Classe Autoload encarrega de incloure el origin de cada fitxer segons l'objecte instanciat.
 * @package App\Core
 */
class Autoload{

	/**
	 * Metode load, encarregat de crida a la funció interna spl_autoload_register, funció màgica que 
	 * inclou fitxers php segons el seu namespace.
	 */
	public static function load(){
		spl_autoload_register(function($class){
			$route = str_replace("\\", "/", $class) . ".php";
			if(is_readable($route)){
				include_once $route;
			}
		});
	}

}

return Autoload::load();

?>