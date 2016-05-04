<?php 

namespace Controllers\Login;

use Controllers\Controller as Controller;
use App\Core\View as View;
use App\Core\Session as Session;

class LoginController extends Controller{

	public function index(){
		if(!$_POST){
        	View::to("login.index");
    	}else{
    		Session::set("user","andreu");
    		View::redirect("worker.index");
    	}
	}

	public function edit($id){
		//TODO
	}

	public function delete($id){
		//TODO
	}

	public function create(){
		//TODO
	}
}


?>