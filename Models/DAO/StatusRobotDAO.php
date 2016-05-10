<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use App\Utility\Debug as Debug;


class StatusRobotDAO {

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE. "status_robot/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		//objecte 
		return $arrayResponse;
	}

	public function getAll(){
		$url = WEBSERVICE. "status_robot/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		//array de objectes statusRobot
		for ($i=0; $i < ; $i++) { 
			# code...
		}
		return $arrayResponse;
	}

	public function create($object){
		$url = WEBSERVICE. "status_robot/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "status_robot/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function delete($id){
		$url = WEBSERVICE. "status_robot/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
}


?>