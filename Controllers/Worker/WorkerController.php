<?php 

namespace Controllers\Worker;

use Models\Business\Worker as Worker;

class WorkerController{

	private $worker;

	public function index(){
		$worker = new Worker();
		$worker->setUsername("Andreu");
		$hola = "Hola treballador";
        return compact('hola', 'worker');
	}
}


?>