<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Task as Task;
use Models\Business\Admin as Admin;
use Models\Business\Team as Team;
use App\Core\Session as Session;
use App\Core\View as View;

class TaskController extends Controller{
    
    protected function create($idOrder, $idTeam) {

    	if(isset($_POST)){
    		$idOrder = $_POST["id_order"];
    		$idTeam = $_POST["id_team"];
	    	$order = new Order($idOrder);
	    	$order = $order->get();

	    	$team = new Team($idTeam);
	    	$team = $team->get();

	    	$task = new Task(null, $team, $order, $worker, $dateAssignation);

	    	$admin = Session::get("user");
	    	$admin->assignOrderToTeam($task);
    	}
        
    }

    protected function delete($id) {
        $task = new Task();
        $task->delete();
    }

    protected function edit($id) {
        if(isset($_POST)){
        	$idOrder = $_POST["id_order"];
        	$idTeam = $_POST["id_team"];
        	$idWorker = $_POST[""];
        }
    }

    protected function index() {
        
    }

}
