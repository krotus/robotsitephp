<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\StatusRobot as StatusRobot;
use Models\Business\Robot as Robot;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\QuickForm as QuickForm;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

/**
 * Classe controladora dels robots que hi hauran dintre de l'aplicació.
 * Hereta de la classe Controller
 * @package \Controllers\Admin
 */
class RobotController extends Controller {

    /**
     * Metode index en el que es renderitza una llista de robots actuals amb opció de reordanament manual entre camps.
     * @return void
     */
    public function index() {
        View::to("admin.robot.index");
    }

    /**
     * Metode edit en el que a partir de la id única del robot podrem actualitza el registre de la taula robots utilitzant la capa de model.
     * També realitza una serie de validacions per tal de que els camps que es recuperen sigin valids per la generació del objecte.
     * @param integer $id La id que identifica de forma única al registre
     * @return void
     */
    public function edit($id) {
        if (!$_POST) {
            $robot = new Robot($id);
            $robot = $robot->get();
            $robotsAll = new Robot();
            $robotCode = $robot->getCode();
            $robots = $robotsAll->getAll();
            $codeRobots = [];
            foreach ($robots as $nRobot){
                if($nRobot->getCode() != $robotCode){
                    $codeRobots[] = $nRobot->getCode();
                }
            }
            $statusRobot = new StatusRobot();
            $status = $statusRobot->getAll();
            View::to("admin.robot.edit", compact('robot', 'status', 'codeRobots'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'robot_code' => $_POST["robot_code"],
                'robot_name' => $_POST["robot_name"],
                'robot_ip_address' => $_POST["robot_ip_address"],
                'robot_latitude' => $_POST["robot_latitude"],
                'robot_longitude' => $_POST["robot_longitude"]
            );
            $rules = array(
                'robot_code' => 'required|numeric|min_len,3',
                'robot_name' => 'required|max_len,50|min_len,3',
                'robot_ip_address' => 'required|max_len,15|min_len,8',
                'robot_latitude' => 'required',
                'robot_longitude' => 'required'
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $admin = unserialize(Session::get("user"));
                $admin->updateRobot(new Robot(
                        $id, 
                        $_POST["robot_code"], 
                        $_POST["robot_name"], 
                        $_POST["robot_ip_address"], 
                        $_POST["robot_latitude"], 
                        $_POST["robot_longitude"], 
                        $_POST["robot_state"],
                        $_POST["robot_ip_cam"]
                ));
                $msg = "S'ha editat satisfactoriament.";
                View::redirect("admin.robot", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.robot.edit." . $id, compact('error'));
            }
        }
    }

    /**
     * Metode delete, elimina un robot a partir de la seva id, ordena al model a eliminar el registre.
     * @param type $id La id identifica de forma única al registre
     * @return void
     */
    public function delete($id) {
        $robot = new Robot($id);
        $robot->delete();
    }


    /**
     * Metode create, renderitza un formulari on a partir de camps que li ariven com a parametres POST, crida al model per crear-ne'n l'objecte
     * i finalment grabar-lo a la base de dades si aquest, es correcte.
     * @return void
     */
    public function create() {
        if (!$_POST) {
            $robot = new Robot();
            $robots = $robot->getAll();
            $codeRobots = [];
            foreach ($robots as $robot){
                $codeRobots[] = $robot->getCode();
            }
            $statusRobot = new StatusRobot();
            $status = $statusRobot->getAll();
            View::to("admin.robot.create", compact('status', 'codeRobots'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'robot_code' => $_POST["robot_code"],
                'robot_name' => $_POST["robot_name"],
                'robot_latitude' => $_POST["robot_latitude"],
                'robot_longitude' => $_POST["robot_longitude"]
            );
            $rules = array(
                'robot_code' => 'required|numeric|min_len,3',
                'robot_name' => 'required|max_len,50|min_len,3',
                'robot_latitude' => 'required',
                'robot_longitude' => 'required'
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $admin = unserialize(Session::get("user"));
                $admin->createRobot(new Robot(
                        null, 
                        $_POST["robot_code"], 
                        $_POST["robot_name"], 
                        null, 
                        $_POST["robot_latitude"], 
                        $_POST["robot_longitude"], 
                        $_POST["robot_state"],
                        $_POST["robot_ip_cam"]
                ));
                $msg = "S'ha creat satisfactoriament.";
                View::redirect("admin.robot", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.robot.create", compact('error'));
            }
        }
    }


    /**
     * Metode getRobotsByAjax que es cridat per una petició Ajax sobre els robots de la base de dades.
     * Utilitzat per la generació de les taules dinamiques que es troben al metode index.
     * En aquest cas un recull dels robots a partir del model.
     * @return string Objecte json amb totes els robots de la taula robots.
     */
    function getRobotsByAjax() {
        ob_end_clean();
        $robot = new Robot();
        $robots = $robot->getAllRobotsAdmin();
        $arrayToSend = array();
        for ($i = 0; $i < count($robots); $i++) {
            $auxArray = array();
            foreach ($robots[$i] as $nRobot) {
                array_push($auxArray, $nRobot);
            }
            array_push($auxArray, "<a href='" . URL . "admin/robot/edit/" . $robots[$i]['id'] . "'><button class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></a><button class='btn btn-danger' onclick='deleteRobot(" . $robots[$i]['id'] . ", \"" . URL . "\");'><span class='glyphicon glyphicon-remove'></span></button>");
            array_shift($auxArray);
            array_push($arrayToSend, $auxArray);
        }
        echo json_encode($arrayToSend);
    }

}

?>