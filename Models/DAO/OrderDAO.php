<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\Business\Robot as Robot;
use Models\Business\Process as Process;
use Models\Business\StatusOrder as StatusOrder;
use App\Utility\Debug as Debug;


class OrderDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE. "orders/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$order = $this->HTTPRequest->sendHTTPRequest();

		$idProcess = $order->getProcess();
		$process = new Process($idProcess);
		$process = $process->get();
		$order->setProcess($process);

		$idRobot = $order->getRobot();
		$robot = new Robot($idRobot);
		$robot = $robot->get();
		$order->setRobot($robot);

		$idStatusOrder = $order->getStatusOrder();
		$statusOrder = new StatusOrder($idStatusOrder);
		$statusOrder = $statusOrder->get();
		$order->setStatusOrder($statusOrder);

		var_dump($order);
		exit;
		return $order;
	}

	public function getAll(){
		$url = WEBSERVICE. "orders/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}

	public function create($object){
		$url = WEBSERVICE. "orders/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "orders/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function delete($id){
		$url = WEBSERVICE. "orders/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
}


?>