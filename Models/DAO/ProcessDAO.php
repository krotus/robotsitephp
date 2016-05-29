<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada als processos.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\ProcessDAO
*/
class ProcessDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un process a partir de la id.

	@param int id del process.
	@return array un array emplenat amb objectes process.
	*/
	public function getById($id){
		$url = WEBSERVICE ."processes/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToProcess($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els process de la taula process del web service

	@return array un array emplenat amb objectes process.
	*/
	public function getAll(){
		$url = WEBSERVICE. "processes/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToProcess($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir un process a la taula processes del web service

	@param object un objecte process amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "processes/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
	/**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar un process a la taula processes del web service

	@param object un objecte process amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "processes/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un Process de la taula processes del web service

	@param int la id de un Process existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "processes/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de processos.

	@param int $items l'array de arrays amb les dades dels processos.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes processos.
	*/
	public function arrayToProcess($processes, $foreigns = false){
		$arrayProcesses = array();
		for ($i=0; $i < count($processes); $i++) { 
			$process = $this->arrayToObject($processes[$i]);
			array_push($arrayProcesses, $process);
		}
		return $arrayProcesses;
	}

	/**
	metode creat per poder obtenir totes les dades de la taula en forma de array bidimensional, en comptes de array de objectes.
	
	aquest metode va ser creat per omplir les dataTables

	@return array un array amb arrays associatius dins amb totes les propietats
	*/
	public function getAllProcessesAdmin()
	{
		$url = WEBSERVICE. "processes/getAllProcessesAdmin";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}

}


?>