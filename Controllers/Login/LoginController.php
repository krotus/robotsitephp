<?php 

namespace Controllers\Login;

use App\Core\View as View;
use App\Core\Session as Session;
use Models\Business\Worker as Worker;
use Models\Business\Admin as Admin;

class LoginController{

	public function index(){
		if(!$_POST){
        	View::to("login.index");
    	}else{
			$user = new Worker();
    		Session::set("user",$user);
            $user->get();
            exit;
    		if(Session::get("user") instanceof Worker){
    			View::redirect(FIRST_PAGE);
    		}else{
    			View::redirect("admin." . FIRST_PAGE_ADMIN);
    		}
    	}
	}
}


?>