<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\Business\Robot as Robot;
use Models\Business\Process as Process;
use Models\Business\StatusOrder as StatusOrder;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;


class OrderDAO extends AbstractDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE. "orders/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToOrder($arrayResponse);
	}

	public function getAll(){
		$url = WEBSERVICE. "orders/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToOrder($arrayResponse);
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

	public function arrayToOrder($orders){
		$arrayOrders = array();
		for ($i=0; $i < count($orders); $i++) { 
			$order = $this->arrayToObject($orders[$i]);
			array_push($arrayOrders, $this->fixForeingOrder($order));
		}
		return $arrayOrders;
	}

	public function fixForeingOrder($order){
		$process = new Process($order->getProcess());
		$process = $process->get();
		$order->setProcess($process);

		$robot = new Robot($order->getRobot());
		$robot = $robot->get();
		$order->setRobot($robot);

		$statusOrder = new StatusOrder($order->getStatusOrder());
		$statusOrder = $statusOrder->get();
		$order->setStatusOrder($statusOrder);

		return $order;
	}

	public function getAllByStatus($worker, $status){
		$url = WEBSERVICE. "orders/getOrdersByStatus/" . $worker ."/" . $status;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}
}


?>