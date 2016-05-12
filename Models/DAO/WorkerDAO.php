<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use Models\Business\Team as Team;
use App\Utility\Debug as Debug;


class WorkerDAO extends AbstractDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE ."workers/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->toWorker($arrayResponse[0]);
	}

	public function getAll(){
		$url = WEBSERVICE. "workers/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		$workers = $this->toWorker($arrayResponse);
		return $workers;
	}

	public function create($object){
		$url = WEBSERVICE. "workers/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "workers/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function delete($id){
		$url = WEBSERVICE. "workers/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function toWorker($items)
	{
		$arrayWorkers = array();
		for ($i=0; $i < count($items); $i++) { 
			$worker = $this->arrayToObject($items[$i]);
			array_push($arrayWorkers, $this->fixForeingWorker($worker));
			//array_push($arrayWorkers, $worker);
		}
		return $arrayWorkers;
	}

	public function fixForeingWorker($worker)
	{
		$team = new Team($worker->getTeam());
		$team = $team->get();
		$worker->setTeam($team);
		return $worker;
	}

}


?>