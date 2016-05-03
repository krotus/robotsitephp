<?php 

namespace Controllers;

use App\Core\Session as Session;
use App\Core\View as View;

class Controller{

	public function language(){
		
		if(Session::get("lang") == "es"){
			Session::set("lang","en");
		}else{
			Session::set("lang","es");
		}
        View::redirect("worker.index");
	}
}

?>