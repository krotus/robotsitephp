<?php 

namespace Models\Business;

use Models\Business\User as User;
use Models\DAO\TaskDAO as TaskDAO;

class Admin extends User{

	public function __construct(){
        parent::__construct($this);
        $this->setIsAdmin(true);
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
}

?>