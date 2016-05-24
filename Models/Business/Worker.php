<?php

namespace Models\Business;

use Models\Business\User as User;
use Models\DAO\TaskDAO as TaskDAO;
use Models\DAO\WorkerDAO as WorkerDAO;

class Worker extends User {

    public function __construct($id = null, $username = null, $password = null, $nif = null, $name = null, $surname = null, $mobile = null, $telephone = null, $category = null, $team = null, $isAdmin = null, $language = null){
        parent::__construct($id, $username, $password, $nif, $name, $surname, $mobile, $telephone, $category, $team, 0, $language);
        $this->setIsAdmin(0);
    }
/**
 * Metode que permet a un treballador afagar una ordre
 * @param type $task
 */
    public function takeOrder($task) {
        $task->setWorker($this);
        $dao = new TaskDAO;
        $dao->update($task);
    }
    /**
     * Metode que permet al treballador finalitzar l'ordre
     * @param type $task
     */
    public function finishOrder($task){
        $dao = new TaskDAO;
        $dao->update($task);
    }
    
    public function updateWorker($worker){
        $worker->update();
    }

    public function getAllWorkersAdmin() {
        $dao = new WorkerDAO();
        return $dao->getAllWorkersAdmin();
    }

}

?>
