<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use Models\Business\Process as Process;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada als punts.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\PointDAO
*/
class PointDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un punt a partir de la id.

	@param int id del punt.
	@return array un array emplenat amb objectes punt.
	*/
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
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els punts de la taula punts del web service

	@return array un array emplenat amb objectes punt.
	*/
	public function create($object){
		$url = WEBSERVICE. "points/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
	/**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar un punt a la taula punts del web service

	@param object un objecte punt amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "points/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un punt de la taula punts del web service

	@param int la id de un punt existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "points/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de punts.

	@param int $items l'array de arrays amb les dades dels punts.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes punts.
	*/
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
    /**
	metode que transforma les id's de les claus foraneas de la punt en objectes.

	@param object $point un objecte punt.
	@return object objecte punt amb els atributs substituits per objectes.
	*/
	public function fixForeingPoint($point){
		$process = new Process($point->getProcess());
		$process = $process->get();
		$point->setProcess($process);
		return $point;
	}

}


?>