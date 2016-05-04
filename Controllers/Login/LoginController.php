<?php 

namespace Controllers\Login;

use Controllers\Controller as Controller;
use App\Core\View as View;

class LoginController extends Controller{

	public function index(){
            View::to("login.index");
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