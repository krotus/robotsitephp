<?php

namespace Models\Business;

use Models\Business\User as User;

class Worker extends User {

    public function __construct() {
        parent::__construct($this);
        $this->setIsAdmin(false);
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