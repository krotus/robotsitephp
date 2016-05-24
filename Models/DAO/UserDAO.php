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


class UserDAO extends AbstractDAO{

	public $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE ."workers/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToUser($arrayResponse, true);
	}

	public function getAll(){
		$url = WEBSERVICE. "workers/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToUser($arrayResponse, false);
	}

	public function create($object){
		$url = WEBSERVICE. "workers/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "workers/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

	public function delete($id){
		$url = WEBSERVICE. "workers/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}

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

	public function fixForeingUser($user){
		$team = new Team($user->getTeam());
		$team = $team->get();
		$user->setTeam($team);

		$language = new Language($user->getLanguage());
		$language = $language->get();
		$user->setLanguage($language);
		return $user;
	}


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