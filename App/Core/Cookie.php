<?php 

namespace App\Core;

/**
 * Classe Cookie, s'utilitza per gestionar més facilment les cookies dintre de l'aplicació.
 * @package \App\Core
 */
class Cookie{

	//constant sobre el temps de vida de cada cookie
	const TIME = 3600; 

	/**
	 * Metode destroy, elimina una cookie segons la seva clau. Se li pot especificar el temps opcionalment.
	 * @param string|bool $key La clau cookie.
	 * @param integer|bool $time Temps de vida a restar-li a la cookie
	 * @return void
	 */
	public static function destroy($key = false, $time = false){
		if($key){
			if($time){
				setcookie($key, "", time()+$time, '/');
			}else{
				setcookie($key, "", time()+self::TIME, '/');
			}
		}
	}

	/**
	 * Metode set, podem generar una nova cookie o actualitzar amb aquest metode, utilitzant clau, valor i temps [opcionalment]
	 * @param string $key Clau unica a la cookie
	 * @param string $value Valor a guardar a la cookie
	 * @param integer|bool $time Valor de durada de la cookie.
	 * @return void
	 */
	public static function set($key, $value, $time = false){
		if(!empty($value)){
			if($time){
				setcookie($key, $value, time()+$time, '/');
			}else{
				setcookie($key, $value, time()+self::TIME, '/');
			}
		}
	}

	/**
	 * Metode get, a partir de la clau que identifica la cookie, podem obtindre el objecte cookie.
	 * @param string $key La clau de la cookie a obtindre.
	 * @return object Objecte Cookie.
	 */
	public static function get($key){
		if(isset($_COOKIE[$key])){
		    return $_COOKIE[$key];
		}
	}

}

?>