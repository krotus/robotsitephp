<?php 

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Worker as Admin;
use App\Core\Session as Session;
use App\Core\View as View;

class DashboardController extends Controller{

	private $worker;

	public function index(){
        View::to("admin.dashboard.index");
	}

	public function edit($id){
		View::to("admin.dashboard.edit");
	}

	public function delete($id){
		//TODO
	}

	public function create(){
		//TODO
	}

}

?>