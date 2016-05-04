<?php 
namespace Models\Business;

use Models\Business\User as User;

class Admin extends User{

	public function __construct(){
            parent::__construct($this);
	}

}

?>