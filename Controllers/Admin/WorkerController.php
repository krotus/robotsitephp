<?php 

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Worker as Admin;
use App\Core\Session as Session;
use App\Core\View as View;

class WorkerController extends Controller{

	private $worker;

	public function index(){
		$user = Session::get("user");
		if($user->getIsAdmin()){
        	View::to("admin.worker.index");
		}else{
			$message = "Lo sentimos, pero no tienes permisos para acceder a esa pagina!";
			View::redirect("worker.index", compact('message'));
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