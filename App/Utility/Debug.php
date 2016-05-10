<?php 

namespace App\Utility;

class Debug{

	public static function log($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
}

?>