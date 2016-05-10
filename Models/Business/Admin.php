<?php 

namespace Models\Business;

use Models\Business\User as User;
use Models\DAO\TaskDAO as TaskDAO;

class Admin extends User{

	public function __construct(){
        parent::__construct($this);
        $this->setIsAdmin(true);
	}
    public function assignOrderToTeam($task){
        $dao = new TaskDAO;
	$dao->create($task);
    }
    public function reassignOrder($task){
        $dao = new TaskDAO;
        $dao->update($task);
    }
}

?>