<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\UserDAO as UserDAO;
use Models\Business\Team as Team;
use App\Utility\Debug as Debug;


class AdminDAO extends UserDAO{

	public function __construct(){
		parent::__construct();
	}

}


?>