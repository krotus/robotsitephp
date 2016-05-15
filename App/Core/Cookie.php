<?php 

namespace App\Core;

class Cookie{

	const TIME = 3600; 

	public static function destroy($key = false, $time = false){
		if($key){
			if($time){
				setcookie($key, "", time()+$time, '/');
			}else{
				setcookie($key, "", time()+self::TIME, '/');
			}
		}
	}

	public static function set($key, $value, $time = false){
		if(!empty($value)){
			if($time){
				setcookie($key, $value, time()+$time, '/');
			}else{
				setcookie($key, $value, time()+self::TIME, '/');
			}
		}
	}

	public static function get($key){
		if(isset($_COOKIE[$key])){
		    return $_COOKIE[$key];
		}
	}

}

?>