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
        //Debug::log($orders);
        $arrToPass = array();       
        for ($i = 0; $i < count($orders); $i++) {
            $auxArray = array();
            foreach ($orders[$i] as $ord) {
                array_push($auxArray, $ord);
            }
            switch ($status) {
                case 'pending':
                    array_push($auxArray, "<input type='button' class='btn btn-success' value='Ejecutar'  onclick='executeOrder(".$orders[$i]['id'].")'>");
                    break;
                case 'initiated':
                    array_push($auxArray, "<button class='btn btn-success' value='' onclick='setCompletedTime(".$orders[$i]['id'].")'><span class='glyphicon glyphicon-ok'></span></button><button class='btn btn-danger' value='' onclick='specifyIssue(".$orders[$i]['id'].")'><span class='glyphicon glyphicon-remove'></span></button>");
                    break;
                case 'cancelled':
                    array_push($auxArray, "<input type='button' class='btn btn-info' value='Marcar como pendiente' onclick='setOrderPending(".$orders[$i]['id'].")'>");
                    break;
                default:
            }
            array_push($arrToPass, $auxArray);
        }

        echo json_encode($arrToPass);
    }

}

?>