<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use App\Utility\Debug as Debug;


class TaskDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE. "task/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}

	public function getAll(){
		$url = WEBSERVICE. "task/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}

	public function create($object){
		$url = WEBSERVICE. "task/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "task/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function delete($id){
		$url = WEBSERVICE. "task/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
}


?>