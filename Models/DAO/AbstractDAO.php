<?php 

namespace Models\DAO;

use App\Utility\Debug as Debug;

/**
clase abstracta que conte tots els metodes basics que ha de contenir un DAO a mes de tenir metodes necesaris per qualsevol DAO.

@package Models\DAO\AbstractDAO
*/
abstract class AbstractDAO{
	/**
	metode abstracte getById que fa una crida al web service i retorna el registre de una base de dades en forma de objecte.
	@param int $id id de la tupla a la BBDD.
	@return object objecte de la classe que el cridi el metode.
	*/
	public abstract function getById($id);
	/**
	metode abstracte getAll que fa una crida al web service i retorna tots els registres de la taula.
	@return array array compost de objectes de la classe que el cridi el metode.
	*/
	public abstract function getAll();
	/**
	metode abstracte create envia un registre nou al web service per ser inserit a la BD.
	@param object $object objecte que es vulgui inserir.
	@return string retorna un string amb el missatge del web service.
	*/
	public abstract function create($object);
	/**
	metode abstracte update envia un registre amb les dades actualitzades al web service per ser actualitzades a la BD.
	@param object $object objecte que tingui l'atribut id en un numero valid.
	@return string retorna un string amb el missatge del web service.
	*/
	public abstract function update($object);
	/**
	metode abstracte delete envia una id al web service per eliminarla a la BD.
	@param int $id numero de un registre existent a la BD.
	@return string retorna un string amb el missatge del web service.
	*/
	public abstract function delete($id);
	/**
	metode creat per poder transformar un array a objecte del seu propi tipus amb els atributs settejats.
	@param array $data un array retornat per el web service.
	@return object un objecte amb els seus atributs settejats.
	*/
	public function arrayToObject($data){
		$namespaceDAO = explode("\\", get_class($this));
		$nameDAO = array_pop($namespaceDAO);
		$pos = strpos($nameDAO, "DAO");
		$class = "\\Models\\Business\\" . substr($nameDAO, 0,$pos);
		$setters  = $this->getSettersFromClass($class);
		$object = new $class;
		$i = 0;
		foreach ($data as $key => $value) {
			$object->$setters[$i]($value);
			$i++;
		}
		return $object;
	}
	/**
	metode creat per poder obtenir els setters de una clase fent us de un metode de la clase DataObject.
	@param nom de la classe de la que es volen els setters.
	@return array un array associatiu amb el nom dels setters.
	*/
  	public function getSettersFromClass($class){
  		$class = new $class;
  		return $class->getSetters();
    }

}


?>