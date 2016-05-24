<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;


class LanguageDAO extends AbstractDAO{

	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}


	public function getById($id){
		$url = WEBSERVICE. "languages/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToLanguage($arrayResponse, true);
	}

	public function getAll(){
		$url = WEBSERVICE. "languages/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToLanguage($arrayResponse, false);
	}

	public function create($object){
		//
	}

	public function update($object){
		//
	}

	public function delete($id){
		//
	}

	public function arrayToLanguage($languages, $foreigns = false){
		$arrayLanguages = array();
		for ($i=0; $i < count($languages); $i++) { 
			$language = $this->arrayToObject($languages[$i]);
			array_push($arrayLanguages, $language);
		}
		return $arrayLanguages;
	}
}


?>