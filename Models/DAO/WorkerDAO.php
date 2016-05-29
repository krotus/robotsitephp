<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\UserDAO as UserDAO;
use Models\Business\Team as Team;
use App\Utility\Debug as Debug;

/**
clase que exten de UserDAO que es el que te la funcionalitat, aquesta clase nomes existeix per coherencia amb el sistema ja que tenim un sistema de crida als DAO de manera dinamica.

@package Models\DAO\WorkerDAO
*/
class WorkerDAO extends UserDAO{

	public function __construct(){
		parent::__construct();
	}
	/**
	metode creat per poder obtenir tots els treballadors en forma de array bidimensional, en comptes de array de objectes.
	
	aquest metode va ser creat per omplir les dataTables

	@return array un array amb arrays associatius dins amb totes les propietats
	*/
	public function getAllWorkersAdmin() {
		$url = WEBSERVICE. "workers/getAllWorkersAdmin";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}


}



?>