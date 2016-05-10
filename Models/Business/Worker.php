<?php 

namespace Models\Business;

use Models\Business\User as User;

class Worker extends User{

	public function __construct(){
        parent::__construct($this);
        $this->setIsAdmin(false);
	}

}

?>