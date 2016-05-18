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
		return $this->arrayToRobots($arrayResponse, true);
	}

	public function getAll(){
		$url = WEBSERVICE. "robots/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToRobots($arrayResponse, false);
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

	public function arrayToRobots($robots, $foreigns = false){
		$arrayRobots = array();
		for ($i=0; $i < count($robots); $i++) { 
			$robot = $this->arrayToObject($robots[$i]);
			if($foreigns){
				$robot = $this->fixForeingRobot($robot);
			}
			$robot = $this->fixCanBeNull($robot);
			array_push($arrayRobots, $robot);
		}
		return $arrayRobots;
	}

	public function fixForeingRobot($robot){
		$statusRobot = new StatusRobot($robot->getStatusRobot());
		$statusRobot = $statusRobot->get();
		$robot->setStatusRobot($statusRobot);
		return $robot;
	}

	public function fixCanBeNull($robot){
		if($robot->getIpAddress() == null){
            $robot->setIpAddress("NULL");
        }
        return $robot;
	}


}


?>