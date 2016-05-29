<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\Business\StatusRobot as StatusRobot;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada als robots.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\RobotDAO
*/
class RobotDAO  extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un robot a partir de la id.

	@param int id del Robot.
	@return array un array emplenat amb objectes Robot.
	*/
	public function getById($id){
		$url = WEBSERVICE. "robots/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToRobots($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els robot de la taula robot del web service

	@return array un array emplenat amb objectes Robot.
	*/
	public function getAll(){
		$url = WEBSERVICE. "robots/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToRobots($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir un robot a la taula robots del web service

	@param object un objecte Robot amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "robots/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
	/**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar una Robot a la taula robots del web service

	@param object un objecte Robot amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "robots/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un Robot de la taula robot del web service

	@param int la id de un Robot existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "robots/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de robot.

	@param int $items l'array de arrays amb les dades dels robot.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes robot.
	*/
	public function arrayToRobots($robots, $foreigns = false){
		$arrayRobots = array();
		for ($i=0; $i < count($robots); $i++) { 
			$robot = $this->arrayToObject($robots[$i]);
			if($foreigns){
				$robot = $this->fixForeingRobot($robot);
			}
			$robot = $this->fixCanBeNull($robot);
			array_push($arrayRobots, $robot);
		}
		return $arrayRobots;
	}
    /**
	metode que transforma les id's de les claus foraneas de la robot en objectes.

	@param object $robot un objecte robot.
	@return object objecte robot amb els atributs substituits per objectes.
	*/
	public function fixForeingRobot($robot){
		$statusRobot = new StatusRobot($robot->getStatusRobot());
		$statusRobot = $statusRobot->get();
		$robot->setStatusRobot($statusRobot);
		return $robot;
	}
	/**
	metode que comproba els camps que poden ser nulls i els hi posa un espai en blanc en cas de ser-ho per evitar problemes al hora de retornar les dades

	@param object $robot un objecte robot.
	@return object objecte robot amb els atributs null substituits per espais en blanc.
	*/
	public function fixCanBeNull($robot){
		if($robot->getIpAddress() == null){
            $robot->setIpAddress("NULL");
        }
        return $robot;
	}
	/**
	metode creat per poder obtenir totes les dades de la taula en forma de array bidimensional, en comptes de array de objectes.
	
	aquest metode va ser creat per omplir les dataTables

	@return array un array amb arrays associatius dins amb totes les propietats
	*/
	public function getAllRobotsAdmin(){
		$url = WEBSERVICE. "robots/getAllRobotsAdmin";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}


}


?>