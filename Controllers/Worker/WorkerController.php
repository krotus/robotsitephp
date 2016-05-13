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

    public function getOrdersByAjax($idWorker, $status) {
        ob_end_clean();
        $order = new Order();
        $orders = $order->getAllByStatus($idWorker, $status);
        echo json_encode($orders);
    }

}

?>