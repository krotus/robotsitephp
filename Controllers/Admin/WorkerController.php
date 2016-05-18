<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Worker as Admin;
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
        View::to("admin.worker.edit");
    }

    public function delete($id) {
        View::to("admin.worker.delete");
    }

    public function create() {
        if(!$_POST){
            $team = new Team();
            $teams = $team->getAll();
            View::to("admin.worker.create", compact('teams'));
        }else{
            $validator = new Gump();
            $inputs = array(
                'worker_username'       =>  $_POST["worker_username"],
                'worker_password'       =>  $_POST["worker_password"],
                'worker_re_password'    =>  $_POST["worker_re_password"],
                'worker_nif'            =>  $_POST["worker_nif"],
                'worker_name'           =>  $_POST["worker_name"],
                'worker_surname'        =>  $_POST["worker_surname"],
                'worker_mobile'         =>  $_POST["worker_mobile"],
                'worker_telephone'      =>  $_POST["worker_telephone"],
                'worker_category'       =>  $_POST["worker_category"],
                'worker_team'           =>  $_POST["worker_team"],
                'worker_is_admin'       =>  $_POST["worker_is_admin"]
            );
            $rules = array(
                'worker_username'       =>  'required|alpha_numeric|min_len,3',
                'worker_password'       =>  'required|max_len,50|min_len,3',
                'worker_re_password'    =>  'required|equalsfield,worker_password',
                'worker_nif'            =>  'required|valid_nif',
                'worker_name'           =>  'required|max_len,50|min_len,3',
                'worker_surname'        =>  'required|max_len,50|min_len,3',
                'worker_mobile'         =>  'required|numeric|exact_len,9',
                'worker_telephone'      =>  'required|numeric|exact_len,9',
                'worker_category'       =>  'required|max_len,50|min_len,3',
                'worker_team'           =>  'required',
                'worker_is_admin'       =>  'required',
            );
            $validated = $validator->validate($inputs, $rules);

            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->createWorker(new Worker(
                    null,
                    $_POST["worker_username"],
                    $_POST["worker_password"],
                    $_POST["worker_nif"],
                    $_POST["worker_name"],
                    $_POST["worker_surname"],
                    $_POST["worker_mobile"],
                    $_POST["worker_telephone"],
                    $_POST["worker_category"],
                    $_POST["worker_team"],
                    $_POST["worker_is_admin"]
                    ));
                $msg = "s'ha creat satisfactoriament.";
                View::redirect("admin.worker", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.worker.create", compact('error'));
            }
        }
    }

}

?>