<?php 

namespace Models\Business;

use Models\Business\User as User;
use Models\DAO\TaskDAO as TaskDAO;

class Admin extends User{

	public function __construct($id = null, $username = null, $password = null, $isAdmin = null, $nif = null, $name = null, $surname = null, $mobile = null, $telephone = null, $category = null, $team = null){
        parent::__construct($id, $username, $password, $isAdmin, $nif, $name, $surname, $mobile, $telephone, $category, $team);
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