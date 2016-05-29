<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada als equips.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\TeamDAO
*/
class TeamDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}
	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un team a partir de la id.

	@param int id del team.
	@return array un array emplenat amb objectes Team.
	*/
	public function getById($id){
		$url = WEBSERVICE. "teams/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToTeam($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els teams de la taula teams del web service

	@return array un array emplenat amb objectes Team.
	*/
	public function getAll(){
		$url = WEBSERVICE. "teams/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToTeam($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir un team a la taula teams del web service

	@param object un objecte Team amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "teams/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar un team a la taula teams del web service

	@param object un objecte Team amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "teams/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un team de la taula teams del web service

	@param int la id de un team existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "teams/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de teams.

	@param int $items l'array de arrays amb les dades dels teams.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes user.
	*/
	public function arrayToTeam($items, $foreigns = false){
		$arrayTeams = array();
		for ($i=0; $i < count($items); $i++) { 
			$team = $this->arrayToObject($items[$i]);
			array_push($arrayTeams, $team);
		}
		return $arrayTeams;
	}
	/**
	metode creat per poder obtenir tots els teams en forma de array bidimensional, en comptes de array de objectes.
	
	aquest metode va ser creat per omplir les dataTables

	@return array un array amb arrays associatius dins amb totes les propietats
	*/
	public function getAllTeamsAdmin() {
		$url = WEBSERVICE. "teams/getAllTeamsAdmin";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}

}


?>