<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada al llenguatge.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\ProcessDAO
*/
class LanguageDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un llenguatge a partir de la id.

	@param int id del llenguatge.
	@return array un array emplenat amb objectes llenguatge.
	*/
	public function getById($id){
		$url = WEBSERVICE. "languages/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToLanguage($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els llenguatge de la taula llenguatge del web service

	@return array un array emplenat amb objectes llenguatge.
	*/
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
    /**
	metode que transforma el array de arrays a array de llenguatge.

	@param int $items l'array de arrays amb les dades dels llenguatge.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes llenguatge.
	*/
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