<?php

namespace Models\Business;

use Models\Business\User as User;

class Worker extends User {

    public function __construct($id = null, $username = null, $password = null, $nif = null, $name = null, $surname = null, $mobile = null, $telephone = null, $category = null, $team = null){
        parent::__construct($id, $username, $password, $nif, $name, $surname, $mobile, $telephone, $category, $team);
        $this->setIsAdmin(0);
    }

    public function takeOrder($task) {
        $task->setWorker($this);
        $dao = new TaskDAO;
        $dao->update($task);
    }
    public function finishOrder($task){
        $dao = new TaskDAO;
        $dao->update($task);
    }
}

?>