<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Process as Process;
use Models\Business\Admin as Admin;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

/**
 * Classe controladora dels processos que hi hauran dintre de l'aplicació.
 * Hereta de la classe Controller
 * @package \Controllers\Admin
 */
class ProcessController extends Controller {

    /**
     * Metode index en el que es renderitza una llista de processos actuals amb opció de reordanament manual entre camps.
     * @return void
     */
    public function index() {
        View::to("admin.process.index");
    }

    /**
     * Metode edit en el que a partir de la id única del procés podrem actualitza el registre de la taula processos utilitzant la capa de model.
     * També realitza una serie de validacions per tal de que els camps que es recuperen sigin valids per la generació del objecte.
     * @param integer $id La id que identifica de forma única al registre
     * @return void
     */
    public function edit($id) {
        if(!$_POST){
            $process = new Process($id);
            $process = $process->get();
            $processAll = new Process();
            $processCode = $process->getCode();
            $processes = $processAll->getAll();
            $codeProcesses = [];
            foreach ($processes as $nProcess){
                if($nProcess->getCode() != $processCode){
                    $codeProcesses[] = $nProcess->getCode();
                }
            }
            View::to("admin.process.edit", compact('process', 'codeProcesses'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'process_code'              =>  $_POST["process_code"],
                'process_description'       =>  $_POST["process_description"],
            );
            $rules = array(
                'process_code'              =>  'required|numeric|min_len,3',
                'process_description'       =>  'required|max_len,50|min_len,3',
            );
            $validated = $validator->validate($inputs, $rules);
            
            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->updateProcess(new Process(
                    $id,
                    $_POST["process_code"],
                    $_POST["process_description"]
                    ));
                $msg = "s'ha editat satisfactoriament.";
                View::redirect("admin.process", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.process.edit.".$id, compact('error'));
            }
        }
    }

    /**
     * Metode delete, elimina un procés a partir de la seva id, ordena al model a eliminar el registre.
     * @param type $id La id identifica de forma única al registre
     * @return void
     */
    public function delete($id) {
       $process = new Process($id);
       $process->delete();
    }

    /**
     * Metode create, renderitza un formulari on a partir de camps que li ariven com a parametres POST, crida al model per crear-ne'n l'objecte
     * i finalment grabar-lo a la base de dades si aquest, es correcte.
     * @return void
     */
    public function create() {
        if(!$_POST){
            $process = new Process();
            $processes = $process->getAll();
            $codeProcesses = [];
            foreach ($processes as $process){
                $codeProcesses[] = $process->getCode();
            }
            View::to("admin.process.create", compact('codeProcesses'));
        }else{
            $validator = new Gump();
            $inputs = array(
                'process_code'              =>  $_POST["process_code"],
                'process_description'       =>  $_POST["process_description"],
            );
            $rules = array(
                'process_code'              =>  'required|numeric|min_len,3',
                'process_description'       =>  'required|max_len,50|min_len,3',
            );
            $validated = $validator->validate($inputs, $rules);

            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->createProcess(new Process(
                    null,
                    $_POST["process_code"],
                    $_POST["process_description"]
                    ));
                $msg = "s'ha creat satisfactoriament.";
                View::redirect("admin.process", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.process.create", compact('error'));
            }
        }
    }

    /**
     * Metode getProcessesByAjax que es cridat per una petició Ajax sobre els processos de la base de dades.
     * Utilitzat per la generació de les taules dinamiques que es troben al metode index.
     * En aquest cas un recull dels processos a partir del model.
     * @return string Objecte json amb totes els processos de la taula processos.
     */
    function getProcessesByAjax(){
        ob_end_clean();
        $process = new Process();
        $processes = $process->getAllProcessesAdmin();
        $arrayToSend = array();
        for ($i = 0; $i < count($processes); $i++) {
            $auxArray = array();
            foreach ($processes[$i] as $nProcess) {
                array_push($auxArray, $nProcess);
            }
                array_push($auxArray, "<a href='" . URL . "admin/process/edit/" . $processes[$i]['id'] . "'><button class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></a><button class='btn btn-danger' onclick='deleteProcess(" . $processes[$i]['id'] . ", \"" . URL . "\");'><span class='glyphicon glyphicon-remove'></span></button>");
                array_shift($auxArray);
                $auxArray[2] = str_replace(",", "<br>", $auxArray[2]);
                array_push($arrayToSend, $auxArray);
        }
        echo json_encode($arrayToSend);
    }
}

?>