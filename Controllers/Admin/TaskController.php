<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Order as Order;
use Models\Business\Task as Task;
use Models\Business\Team as Team;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

class TaskController extends Controller {

    private $task;

    public function index() {
        View::to("admin.task.index");
    }

    public function edit($id) {

    }

    public function delete($id) {
        View::to("admin.task.delete");
    }

    public function create() {
        if(!$_POST){
            $team = new Team();
            $teams = $team->getAll();
            $order = new Order();
            $orders = $order->getAll();
            View::to("admin.task.create", compact('teams','orders'));
        }else{
            $validator = new Gump();
            $inputs = array(
                'task_team'              =>  $_POST["task_team"],
                'task_order'             =>  $_POST["task_order"]
            );
            $rules = array(
                'task_team'               =>  'required',
                'task_order'              =>  'required'
            );
            $validated = $validator->validate($inputs, $rules);

            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->createTask(new Task(
                    null,
                    $_POST["task_team"],
                    $_POST["task_order"],
                    null, //worker
                    null, //date assignació per sql
                    null, //data completion
                    null //justification
                    ));
                $msg = "s'ha creat satisfactoriament.";
                View::redirect("admin.task", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.task.create", compact('error'));
            }
        }
    }

}

?>