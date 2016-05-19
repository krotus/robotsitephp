<?php 

namespace Models\Business;

use Models\Business\User as User;
use Models\DAO\TaskDAO as TaskDAO;

class Admin extends User{

	public function __construct($id = null, $username = null, $password = null, $nif = null, $name = null, $surname = null, $mobile = null, $telephone = null, $category = null, $team = null){
        parent::__construct($id, $username, $password, $nif, $name, $surname, $mobile, $telephone, $category, $team);
        $this->setIsAdmin(1);
	}
         /**
         * Metode que assigna una ordre a un equip mitjançant una tasca
         * @param type $task
         */
    public function assignOrderToTeam($task){
        $dao = new TaskDAO;
        $dao->create($task);
    }
    /**
     * Ens permet reasignar una ordre a partir de la tasca
     * @param type $task 
     */
    public function reassignOrder($task){
        $dao = new TaskDAO;
        $dao->update($task);
    }

    public function createWorker($worker){
        $worker->create();
    }

    public function updateWorker($worker){
        $worker->update();
    }
    
    public function createTeam($team)  {
        $team->create();
    }

    public function updateTeam($team){
        $team->update();
    }

    public function createRobot($robot){
        $robot->create();
    }
    
    public function updateRobot($robot){
        $robot->update();
    }

    public function createProcess($process){
        $process->create();
    }

    public function updateProcess($process){
        $process->update();
    }

    public function createOrder($order){
        $order->create();
    }

    public function updateOrder($order){
        $order->update();
    }

    public function createTask($task){
        $task->create();
    }

    public function updateTask($task){
        $task->update();
    }
}

?>
