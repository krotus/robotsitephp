<?php 

namespace App\Core;

use App\Core\View as View;

/**
 * Classe Session, utilitzada per gestionar les diferents sessions que navegaran durant el seu crus de vida
 * dintre de l'aplicació.
 * @package \App\Core
 */
class Session{

	/**
	 * Metode init, encarregat d'activar la sessió/sessions de l'aplicació
	 * @return void
	 */
	public static function init(){
		session_start();
	}

	/**
	 * Metode destroy, on a partir del nom de la sessió aquesta s'elimina si existeix.
	 * @param string|bool $key Clau que identifica la sessió (nom)
	 * @return void
	 */
	public static function destroy($key = false){
		if($key){
			if(is_array($key)){
				for($i = 0; $i < count($key); $i++){
                    if(isset($_SESSION[$key[$i]])){
                        unset($_SESSION[$key[$i]]);
                    }
                }
			}else{
				if(isset($_SESSION[$key])){
                    unset($_SESSION[$key]);
                }
			}
		}else{
			session_destroy();
		}
	}

	/**
	 * Metode set, on a partir d'un nom, i un valor podrem generar la sessió que volguem per 
	 * poder-la utilitzar dintre de l'aplicació.
	 * @param string $key Clau que identificarà la sessió
	 * @param string $value Valor de la sessió
	 * @return void
	 */
	public static function set($key, $value){
		if(!empty($value)){
			$_SESSION[$key] = $value;
		}
	}

	/**
	 * Metode get, on a partir de la clau de la sessió obtenim el seu valor que la conté.
	 * @param string $key Clau de la sessió
	 * @return object Objecte de la sessió preguntada.
	 */
	public static function get($key){
		if(isset($_SESSION[$key])){
		    return $_SESSION[$key];
		}
	}

	/**
	 * Metode isLogged, permet coneixer si tenim un usuari que hagi iniciat sessió a partir de la clau user.
	 * @return boolean Cert en cas d'haver iniciat sessió, fals en cas contrari.
	 */
	public static function isLogged(){
		$login = false;

		if(self::get("user")){
			$login = true;
		}
		
		return $login;
	}

}

?>