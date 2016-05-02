<?php 

namespace Controllers\Worker;

use Models\Business\Worker as Worker;
use App\Core\View as View;

class WorkerController{

	private $worker;

	public function index(){
		$worker = new Worker();
		$worker->setUsername("Andreu");
		$hola = "Hola treballador";
        View::to("worker.index", compact("hola","worker"));
	}

	public function edit(){
	}
}


?>