<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\Business\StatusRobot as StatusRobot;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;


class RobotDAO  extends AbstractDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE. "robots/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToRobots($arrayResponse);
	}

	public function getAll(){
		$url = WEBSERVICE. "robots/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToRobots($arrayResponse);
	}

	public function create($object){
		$url = WEBSERVICE. "robots/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "robots/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function delete($id){
		$url = WEBSERVICE. "robots/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function arrayToRobots($robots){
		$arrayRobots = array();
		for ($i=0; $i < count($robots); $i++) { 
			$robot = $this->arrayToObject($robots[$i]);
			array_push($arrayRobots, $this->fixForeingRobot($robot));
		}
		return $arrayRobots;
	}

	public function fixForeingRobot($robot){
		$statusRobot = new StatusRobot($robot->getStatusRobot());
		$statusRobot = $statusRobot->get();
		$robot->setStatusRobot($statusRobot);
		return $robot;
	}


}


?>