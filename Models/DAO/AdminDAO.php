<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\UserDAO as UserDAO;
use Models\Business\Team as Team;
use App\Utility\Debug as Debug;

/**
clase que exten de UserDAO que es el que te la funcionalitat, aquesta clase nomes existeix per coherencia amb el sistema ja que tenim un sistema de crida als DAO de manera dinamica.

@package Models\DAO\AdminDAO
*/
class AdminDAO extends UserDAO{

	public function __construct(){
		parent::__construct();
	}

}


?>