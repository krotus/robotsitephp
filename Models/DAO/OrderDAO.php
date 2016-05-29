<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\Business\Robot as Robot;
use Models\Business\Process as Process;
use Models\Business\StatusOrder as StatusOrder;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada als processos.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\OrderDAO
*/
class OrderDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un ordre a partir de la id.

	@param int id del ordre.
	@return array un array emplenat amb objectes ordre.
	*/
	public function getById($id){
		$url = WEBSERVICE. "orders/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToOrder($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els ordre de la taula orders del web service

	@return array un array emplenat amb objectes ordre.
	*/
	public function getAll(){
		$url = WEBSERVICE. "orders/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToOrder($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir un order a la taula orders del web service

	@param object un objecte order amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "orders/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
	/**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar un order a la taula orders del web service

	@param object un objecte order amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "orders/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un order de la taula orders del web service

	@param int la id de un order existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "orders/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de orders.

	@param int $items l'array de arrays amb les dades dels orders.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes orders.
	*/
	public function arrayToOrder($orders, $foreigns = false){
		$arrayOrders = array();
		for ($i=0; $i < count($orders); $i++) { 
			$order = $this->arrayToObject($orders[$i]);
			if($foreigns){
				$order = $this->fixForeingOrder($order);
			}
			array_push($arrayOrders, $order);
		}
		return $arrayOrders;
	}

    /**
	metode que transforma les id's de les claus foraneas de la order en objectes.

	@param object $order un objecte order.
	@return object objecte order amb els atributs substituits per objectes.
	*/
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
	/**
	metode creat per poder obtenir totes les dades de la taula filtrades per la id del treballador i el estat de la ordre en forma de array bidimensional.
	
	aquest metode va ser creat per omplir les dataTables

	@return array un array amb arrays associatius dins amb totes les propietats
	*/
	public function getAllByStatus($worker, $status){
		$url = WEBSERVICE. "orders/getOrdersByStatus/" . $worker ."/" . $status;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}
	/**
	metode creat per poder obtenir totes les dades de la taula en forma de array bidimensional, en comptes de array de objectes.
	
	aquest metode va ser creat per omplir les dataTables

	@return array un array amb arrays associatius dins amb totes les propietats
	*/
	public function getAllOrdersAdmin()	{
		$url = WEBSERVICE. "orders/getAllOrdersAdmin";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}
    /**
	metode creat per poder obtenir totes les dades per crear les estadistiques
	
	@return array 
	*/    
	public function getStadisticOrders($object)	{
		$url = WEBSERVICE. "orders/stadisticsOrders";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
}


?>