<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use Models\Business\Process as Process;
use App\Utility\Debug as Debug;


class PointDAO extends AbstractDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE ."points/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToPoint($arrayResponse, true);
	}

	public function getAll(){
		$url = WEBSERVICE. "points/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToPoint($arrayResponse, false);
	}

	public function create($object){
		$url = WEBSERVICE. "points/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "points/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function delete($id){
		$url = WEBSERVICE. "points/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function arrayToPoint($points, $foreigns = false){
		$arrayPoints = array();
		for ($i=0; $i < count($points); $i++) { 
			$point = $this->arrayToObject($points[$i]);
			if($foreigns){
				$point = $this->fixForeingPoint($point);
			}
			array_push($arrayPoints, $point);
		}
		return $arrayPoints;
	}

	public function fixForeingPoint($point){
		$process = new Process($point->getProcess());
		$process = $process->get();
		$point->setProcess($process);
		return $point;
	}

}


?>