<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use Models\Business\Team as Team;
use Models\Business\Language as Language;
use Models\Business\Admin as Admin;
use Models\Business\Worker as Worker;
use Models\Business\User as User;
use App\Utility\Debug as Debug;

/**
Clase mare de worker i admin, conte tota la funcionalitat associada als usuaris.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\UserDAO
*/
class UserDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	public $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un usuari a partir de la id.

	@param int id del usuari.
	@return array un array emplenat amb objectes User.
	*/
	public function getById($id){
		$url = WEBSERVICE ."workers/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToUser($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els usuaris de la taula users del web service

	@return array un array emplenat amb objectes User.
	*/
	public function getAll(){
		$url = WEBSERVICE. "workers/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToUser($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir un usuari a la taula users del web service

	@param object un objecte user amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "workers/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar un usuari a la taula users del web service

	@param object un objecte user amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "workers/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar un usuari de la taula users del web service

	@param int la id de un usuari existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "workers/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de users.

	@param int $users l'array de arrays amb les dades dels usuaris.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes user.
	*/
	public function arrayToUser($users,$foreigns = false){
		$arrayUsers = array();
		for ($i=0; $i < count($users); $i++) { 
			$user = $this->arrayToObject($users[$i]);
			if($foreigns){
				$user = $this->fixForeingUser($user);
			}
			array_push($arrayUsers, $user);
		}
		return $arrayUsers;
	}
    /**
	metode que transforma les id's de les claus foraneas del usuari en objectes.

	@param object $user un objecte usuari.
	@return object objecte user amb els atributs substituits per objectes.
	*/
	public function fixForeingUser($user){
		$team = new Team($user->getTeam());
		$team = $team->get();
		$user->setTeam($team);

		$language = new Language($user->getLanguage());
		$language = $language->get();
		$user->setLanguage($language);
		return $user;
	}

    /**
	metode sobreescrit del metode arrayToObject del AbstractDAO.

	el proposit de aquest metode es instanciar un worker o un admin segons l'atribut isAdmin de user ja que al validar es comproba la instancia del objecte no el attribut isAdmin.

	@param array $data un array retornat per el web service.
	@return object un objecte user amb els seus atributs settejats.
	*/
	public function arrayToObject($data){
		$setters  = $this->getSettersFromClass(new User);
		$object = new User;
		$i = 0;
		foreach ($data as $key => $value) {
			$object->$setters[$i]($value);
			$i++;
		}
		if($object->getIsAdmin() == 1 ){
			$user = new Admin(
				$object->getId(),
				$object->getUsername(),
				$object->getPassword(),
				$object->getNif(),
				$object->getName(),
				$object->getSurname(),
				$object->getMobile(),
				$object->getTelephone(),
				$object->getCategory(),
				$object->getTeam(),
				1,
				$object->getLanguage()
			);
		}else{
			$user = new Worker(
				$object->getId(),
				$object->getUsername(),
				$object->getPassword(),
				$object->getNif(),
				$object->getName(),
				$object->getSurname(),
				$object->getMobile(),
				$object->getTelephone(),
				$object->getCategory(),
				$object->getTeam(),
				0,
				$object->getLanguage()
			);
		}
		return $user;
	}
	

}


?>