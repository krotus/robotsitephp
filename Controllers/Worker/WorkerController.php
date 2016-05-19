<?php

namespace Controllers\Worker;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Order as Order;
use Models\Business\Task as Task;
use Models\Business\Team as Team;
use App\Core\View as View;
use App\Core\Session as Session;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;


class WorkerController extends Controller {

    private $worker;

    public function index() {
        $workerName = unserialize(Session::get('user'))->getName();
        View::to("worker.index", compact("workerName"));
    }

    public function edit($id) {
        //TODO
    }

    public function delete($id) {
        //TODO
    }
    
    public function profile() {
        if (!$_POST) {
            $worker = unserialize(Session::get('user'));
            View::to("worker.profile", compact('worker'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'worker_username' => $_POST["worker_username"],
                'worker_password' => $_POST["worker_password"],
                'worker_re_password' => $_POST["worker_re_password"],
                'worker_nif' => $_POST["worker_nif"],
                'worker_name' => $_POST["worker_name"],
                'worker_surname' => $_POST["worker_surname"],
                'worker_mobile' => $_POST["worker_mobile"],
                'worker_telephone' => $_POST["worker_telephone"],
                'worker_category' => $_POST["worker_category"]
            );
            $rules = array(
                'worker_username' => 'required|alpha_numeric|min_len,3',
                'worker_password' => 'required|max_len,50|min_len,3',
                'worker_re_password' => 'required|equalsfield,worker_password',
                'worker_nif' => 'required|valid_nif',
                'worker_name' => 'required|max_len,50|min_len,3',
                'worker_surname' => 'required|max_len,50|min_len,3',
                'worker_mobile' => 'required|numeric|exact_len,9',
                'worker_telephone' => 'required|numeric|exact_len,9',
                'worker_category' => 'required|max_len,50|min_len,3'
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $worker = unserialize(Session::get("user"));
                $nWorker = new Worker(
                        $worker->getId(), 
                        $_POST["worker_username"], 
                        $_POST["worker_password"], 
                        $_POST["worker_nif"], 
                        $_POST["worker_name"], 
                        $_POST["worker_surname"], 
                        $_POST["worker_mobile"], 
                        $_POST["worker_telephone"], 
                        $_POST["worker_category"], 
                        $worker->getTeam()->getId()
                );
                $team = new Team($worker->getTeam()->getId());
                $team = $team->get();
                $worker->updateWorker($nWorker);
                $nWorker->setTeam($team);
                Session::set('user', serialize($nWorker));
                $msg = "s'ha editat satisfactoriament.";
                View::redirect("worker", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("worker.profile", compact('error'));
            }
        }
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