<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Admin as Admin;
use Models\Business\Team as Team;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\QuickForm as QuickForm;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

class WorkerController extends Controller {

    private $worker;

    public function index() {
        View::to("admin.worker.index");
    }

    public function edit($id) {
        if (!$_POST) {
            $worker = new Worker($id);
            $worker = $worker->get();
            $team = new Team();
            $teams = $team->getAll();
            View::to("admin.worker.edit", compact('worker', 'teams'));
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
                'worker_category' => $_POST["worker_category"],
                'worker_team' => $_POST["worker_team"],
                'worker_is_admin' => $_POST["worker_is_admin"]
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
                'worker_category' => 'required|max_len,50|min_len,3',
                'worker_team' => 'required',
                'worker_is_admin' => 'required',
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $admin = unserialize(Session::get("user"));
                $admin->updateWorker(new Worker(
                        $id, $_POST["worker_username"], $_POST["worker_password"], $_POST["worker_nif"], $_POST["worker_name"], $_POST["worker_surname"], $_POST["worker_mobile"], $_POST["worker_telephone"], $_POST["worker_category"], $_POST["worker_team"], $_POST["worker_is_admin"]
                ));
                $msg = "s'ha editat satisfactoriament.";
                View::redirect("admin.worker", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.worker.edit." . $id, compact('error'));
            }
        }
    }

    public function getWorkersByAjax() {
        ob_end_clean();
        $worker = new Worker();
        $workers = $worker->getAllWorkersAdmin();
        //Debug::log($workers);
        //exit();
        $arrayToSend = array();
        for ($i = 0; $i < count($workers); $i++) {
            $auxArray = array();
            foreach ($workers[$i] as $worker) {
                array_push($auxArray, $worker);
            }
            $loggedId = unserialize(Session::get('user'))->getId();
            if (strval($loggedId) == $auxArray[0]) {
                array_push($auxArray, "<a href='" . URL . "admin/profile'><button class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></a><button class='btn btn-danger' disabled><span class='glyphicon glyphicon-remove'></span></button>");
            } else {
                array_push($auxArray, "<a href='" . URL . "admin/worker/edit/" . $workers[$i]['id'] . "'><button class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></a><button class='btn btn-danger' onclick='deleteWorker(".$workers[$i]['id'].", \"".URL."\");'><span class='glyphicon glyphicon-remove'></span></button>");
            }
            array_shift($auxArray);
            if ($auxArray[7] == 1) {
                $auxArray[7] = "<span class='glyphicon glyphicon-ok'></span>";
            } else {
                $auxArray[7] = "<span class='glyphicon glyphicon-remove'></span>";
            }
            
            array_push($arrayToSend, $auxArray);
        }

        //Debug::log($arrayToSend);
        echo json_encode($arrayToSend);
    }

    public function delete($id) {
        $worker = new Worker($id);
        $worker->delete();
    }

    public function create() {
        if (!$_POST) {
            $team = new Team();
            $teams = $team->getAll();
            View::to("admin.worker.create", compact('teams'));
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
                'worker_category' => $_POST["worker_category"],
                'worker_team' => $_POST["worker_team"],
                'worker_is_admin' => $_POST["worker_is_admin"]
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
                'worker_category' => 'required|max_len,50|min_len,3',
                'worker_team' => 'required',
                'worker_is_admin' => 'required',
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $admin = unserialize(Session::get("user"));
                $admin->createWorker(new Worker(
                        null, $_POST["worker_username"], $_POST["worker_password"], $_POST["worker_nif"], $_POST["worker_name"], $_POST["worker_surname"], $_POST["worker_mobile"], $_POST["worker_telephone"], $_POST["worker_category"], $_POST["worker_team"], $_POST["worker_is_admin"]
                ));
                $msg = "s'ha creat satisfactoriament.";
                View::redirect("admin.worker", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.worker.create", compact('error'));
            }
        }
    }

}

?>