<?php

namespace Controllers\Worker;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Order as Order;
use App\Core\View as View;
use App\Utility\Debug as Debug;

class WorkerController extends Controller {

    private $worker;

    public function index() {
        $worker = new Worker();
        $worker->setUsername("Andreu");
        $hola = "Hola treballador";
        $marc = "Marc";
        View::to("worker.index", compact("hola", "worker", "marc"));
    }

    public function edit($id) {
        //TODO
    }

    public function delete($id) {
        //TODO
    }

    public function create() {
        if (!$_POST) {
            View::to("worker.create");
        } else {
            View::redirect("worker.index");
        }
    }

    public function getordersbyajax() {

        /*$order = new Order();
        var_dump($order->getAll());
        exit;
        $orders = $order->getAll();
        $ordArrays = array();
        foreach ($orders as $ord) {
            array_push($ordArrays, $ord->objectToArray($ord));
        }
        var_dump($ordArrays);*/
    }


	public function ajax(){
		$order = new Order();
		var_dump($order->getAll());
	}


}

?>