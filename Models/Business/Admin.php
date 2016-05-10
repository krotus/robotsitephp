<?php 

namespace Models\Business;

use Models\Business\User as User;

class Admin extends User{

	public function __construct(){
        parent::__construct($this);
        $this->setIsAdmin(true);
	}
    public function assignOrderToTeam($task){
        $dao = new TaskDAO;
	$dao->insert($task);
    }
    public function reassignOrder($task){
        $dao = new OrderDAO;
        $dao->update($task);
    }
}

?>