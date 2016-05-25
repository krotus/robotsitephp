<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Process as Process;
use Models\Business\Admin as Admin;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

class ProcessController extends Controller {

    private $process;

    public function index() {
        View::to("admin.process.index");
    }

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

    public function delete($id) {
       $process = new Process($id);
       $process->delete();
    }

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

    
    function getProcessesByAjax(){
        ob_end_clean();
        $process = new Process();
        $processes = $process->getAllProcessesAdmin();
//        Debug::log($processes);
//        exit();
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