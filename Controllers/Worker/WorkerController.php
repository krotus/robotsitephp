<?php

namespace Controllers\Worker;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Order as Order;
use Models\Business\Task as Task;
use App\Core\View as View;
use App\Core\Session as Session;
use App\Utility\Debug as Debug;

class WorkerController extends Controller {

    private $worker;

    public function index() {
        $workerName = unserialize(Session::get('user'))->getName();
        View::to("worker.index", compact("workerName"));
    }

    public function edit($id) {
        //TODO
    }

    public function profile() {
        $worker = unserialize(Session::get('user'));
        View::to("worker.profile", compact("worker"));
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
        $task = new Task();
        $tasks = $task->getAll();
//        Debug::log($orders);
//        exit();
        $arrToPass = array();
        for ($i = 0; $i < count($orders); $i++) {
            $auxArray = array();
            foreach ($orders[$i] as $ord) {
                array_push($auxArray, $ord);
            }
            switch ($status) {
                case 'pending':
                    array_push($auxArray, "<input type='button' class='btn btn-success' value='Ejecutar'  onclick='executeOrder(" . $orders[$i]['id'] . ", 2, " . unserialize(\App\Core\Session::get('user'))->getId() . ", \"" . URL . "\")'>");
                    break;
                case 'initiated':
                    $taskFound = new Task();
                    for ($j = 0; $j < count($tasks); $j++) {
                        if ($tasks[$j]->getOrder() == $orders[$i]['id']) {
                            $taskFound = $tasks[$j];
                        }
                    }
                    if ($taskFound->getWorker() == $idWorker) {
                        array_push($auxArray, "<button class='btn btn-success' value='' onclick='setCompletedTime(" . $orders[$i]['id'] . ")'><span class='glyphicon glyphicon-ok'></span></button><button class='btn btn-danger' value='' onclick='specifyIssue(" . $orders[$i]['id'] . ")'><span class='glyphicon glyphicon-remove'></span></button>");
                    } else {
                        array_push($auxArray, "<button class='btn btn-disabled' value=''><span class='glyphicon glyphicon-ok'></span></button><button class='btn btn-disabled' value=''><span class='glyphicon glyphicon-remove'></span></button>");
                    }
                    break;
                case 'cancelled':
                    array_push($auxArray, "<input type='button' class='btn btn-info' value='Marcar como pendiente' onclick='setOrderPending(" . $orders[$i]['id'] . ", 1, " . unserialize(\App\Core\Session::get('user'))->getId() . ", \"" . URL . "\")'>");
                    break;
                default:
            }
            array_push($arrToPass, $auxArray);
        }

        echo json_encode($arrToPass);
    }

}

?>