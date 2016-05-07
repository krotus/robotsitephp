<?php 

namespace Controllers\Login;

use Controllers\Controller as Controller;
use App\Core\View as View;
use App\Core\Session as Session;
use Models\Business\Worker as Worker;
use Models\Business\Admin as Admin;

class LoginController extends Controller{

	public function index(){
		if(!$_POST){
        	View::to("login.index");
    	}else{
			$user = new Worker();
    		Session::set("user",$user);
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