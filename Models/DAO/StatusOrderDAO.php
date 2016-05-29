<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada als estats de la ordre.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\StatusOrderDAO
*/
class StatusOrderDAO  extends AbstractDAO {
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un status order a partir de la id.

	@param int id del status order.
	@return array un array emplenat amb objectes status order.
	*/
	public function getById($id){
		$url = WEBSERVICE. "status_order/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToStatusOrder($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els status order de la taula status order del web service

	@return array un array emplenat amb objectes statusOrder.
	*/
	public function getAll(){
		$url = WEBSERVICE. "status_order/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToStatusOrder($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir un status order a la taula status_order del web service

	@param object un objecte StatusOrder amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "status_order/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar una statusOrder a la taula status_order del web service

	@param object un objecte statusOrder amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "status_order/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un statusOrder de la taula status_order del web service

	@param int la id de un statusOrder existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "status_order/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de StatusOrder.

	@param int $items l'array de arrays amb les dades dels StatusOrder.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes StatusOrder.
	*/
	public function arrayToStatusOrder($statusOrders,$foreigns = false){
		$arrayStatusOrder = array();
		for ($i=0; $i < count($statusOrders); $i++) { 
			$statusOrder = $this->arrayToObject($statusOrders[$i]);
			array_push($arrayStatusOrder, $statusOrder);
		}
		return $arrayStatusOrder;
	}


}


?>