<?php 

namespace App\Core;

use App\Core\View as View;

class Session{


	public static function init(){
		session_start();
	}


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

	public static function set($key, $value){
		if(!empty($value)){
			$_SESSION[$key] = $value;
		}
	}

	public static function get($key){
		if(isset($_SESSION[$key])){
		    return $_SESSION[$key];
		}
	}

	public static function isLogged(){
		$login = false;

		if(self::get("user")){
			$login = true;
		}
		
		return $login;
	}

}

?>