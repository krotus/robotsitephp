<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;


class WorkerDAO{

	private $HTTPRequest;

	public function __construct(){
		$HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = "http://localhost/api.arduino.com/v1/workers/getById/" . $id;
		$HTTPRequest->setUrl($url);
		$HTTPRequest->setMethod("GET");
		$json = $HTTPRequest->sendHTTPRequest();
		var_dump($json);
	}
}


?>