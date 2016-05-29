<?php 

namespace Models\DAO;

use Models\DAO\AbstractDAO as AbstractDAO;
use Models\DAO\HTTPRequest as HTTPRequest;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada als estats del robot.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\StatusRobotDAO
*/
class StatusRobotDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un status robot a partir de la id.

	@param int id del status robot.
	@return array un array emplenat amb objectes status robot.
	*/
	public function getById($id){
		$url = WEBSERVICE. "status_robot/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToStatusRobot($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els status robot de la taula status robot del web service

	@return array un array emplenat amb objectes statusRobot.
	*/
	public function getAll(){
		$url = WEBSERVICE. "status_robot/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToStatusRobot($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir un status robot a la taula status_robot del web service

	@param object un objecte StatusRobot amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "status_robot/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar una statusRobot a la taula status_robot del web service

	@param object un objecte statusRobot amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "status_robot/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un statusRobot de la taula status_robot del web service

	@param int la id de un statusRobot existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "status_robot/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

    /**
	metode que transforma el array de arrays a array de StatusRobot.

	@param int $items l'array de arrays amb les dades dels StatusRobot.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes StatusRobot.
	*/
	public function arrayToStatusRobot($statusRobots, $foreigns = false){
		$arrayStatusRobot = array();
		for ($i=0; $i < count($statusRobots); $i++) { 
			$statusRobot = $this->arrayToObject($statusRobots[$i]);
			array_push($arrayStatusRobot, $statusRobot);
		}
		return $arrayStatusRobot;
	}


}


?>