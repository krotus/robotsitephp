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


/**
 * Classe controladora de les tasques que hi hauran dintre de l'aplicació.
 * Hereta de la classe Controller
 * @package \Controllers\Admin
 */
class TaskController extends Controller {


    /**
     * Metode index en el que es renderitza una llista de tasques actuals amb opció de reordanament manual entre camps.
     * @return void
     */
    public function index() {
        View::to("admin.task.index");
    }

    /**
     * Metode edit en el que a partir de la id única de la tasca podrem actualitza el registre de la taula tasques utilitzant la capa de model.
     * També realitza una serie de validacions per tal de que els camps que es recuperen sigin valids per la generació del objecte.
     * @param integer $id La id que identifica de forma única al registre
     * @return void
     */
    public function edit($id) {
        if(!$_POST){
            $task = new Task($id);
            $task = $task->get();
            $team = new Team();
            $teams = $team->getAll();
            $order = new Order();
            $orders = $order->getAll();
            $worker = new Worker();
            $workers = $worker->getAll();
            $workersTaskTeam = array();
            for ($i=0; $i < count($workers); $i++) { 
                if ($workers[$i]->getTeam() == $task->getTeam()->getId()) {
                    array_push($workersTaskTeam, $workers[$i]);
                }
            }
            View::to("admin.task.edit", compact('task','teams','orders','workersTaskTeam'));
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
                $admin->updateTask(new Task(
                    $id,
                    $_POST["task_team"],
                    $_POST["task_order"],
                    $_POST["task_worker"], //worker
                    null, //date assignació per sql
                    $_POST["task_date_completion"], //data completion
                    $_POST["task_justification"]
                    ));
                $msg = "s'ha editat satisfactoriament.";
                View::redirect("admin.task", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.task.edit", compact('error'));
            }
        }
    }

    /**
     * Metode delete, elimina una tasca a partir de la seva id, ordena al model a eliminar el registre.
     * @param type $id La id identifica de forma única al registre
     * @return void
     */
    public function delete($id) {
        $task = new Task($id);
        $task->delete();
    }

    /**
    * Metode create, renderitza un formulari on a partir de camps que li ariven com a parametres POST, crida al model per crear-ne'n l'objecte
    * i finalment grabar-lo a la base de dades si aquest, es correcte.
    * @return void
    */
    public function create() {
        if (!$_POST) {
            $team = new Team();
            $teams = $team->getAll();
            $order = new Order();
            $orders = $order->getAll();
            View::to("admin.task.create", compact('teams', 'orders'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'task_team' => $_POST["task_team"],
                'task_order' => $_POST["task_order"]
            );
            $rules = array(
                'task_team' => 'required',
                'task_order' => 'required'
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
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
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.task.create", compact('error'));
            }
        }
    }

    /**
     * Metode getTasksByAjax que es cridat per una petició Ajax sobre les tasques de la base de dades.
     * Utilitzat per la generació de les taules dinamiques que es troben al metode index.
     * En aquest cas un recull les tasques a partir del model.
     * @return string Objecte json amb totes les tasques de la tles tasques.
     */
    function getTasksByAjax() {
        ob_end_clean();
        $task = new Task();
        $tasks = $task->getAllTasksAdmin();
        $arrayToSend = array();
        for ($i = 0; $i < count($tasks); $i++) {
            $auxArray = array();
            foreach ($tasks[$i] as $nTask) {
                array_push($auxArray, $nTask);
            }
            array_push($auxArray, "<a href='" . URL . "admin/task/edit/" . $tasks[$i]['id'] . "'><button class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></a><button class='btn btn-danger' onclick='deleteTask(" . $tasks[$i]['id'] . ", \"" . URL . "\");'><span class='glyphicon glyphicon-remove'></span></button>");
            array_push($arrayToSend, $auxArray);
        }
        echo json_encode($arrayToSend);
    }

}

?>
