<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\UserDAO as UserDAO;
use Models\Business\Team as Team;
use App\Utility\Debug as Debug;


class WorkerDAO extends UserDAO{

	public function __construct(){
		parent::__construct();
	}

	public function getAllWorkersAdmin() {
		$url = WEBSERVICE. "workers/getAllWorkersAdmin";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}


}



?>