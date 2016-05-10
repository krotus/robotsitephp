<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use App\Utility\Debug as Debug;


class WorkerDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = "http://localhost/api.arduino.com/v1/workers/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$json = $this->HTTPRequest->sendHTTPRequest();
		Debug::log($json);
		var_dump("wtf");
	}
}


?>