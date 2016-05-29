<?php 

namespace App\Utility;

/**
 * Classe Debug que te como a proposit generar codi HTML de forma dinamica segons
 * la necessitat que requereixi la vista a renderitzar.
 * @package \App\Utility
 */
class Debug{

	/**
	 * Metode log, on te com a proposit mostrar per pantalla de forma bonica un element/variable a analitzar.
	 * @param any $var Qualsevol tipus de variable a analitzar 
	 * @return void
	 */
	public static function log($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
}

?>