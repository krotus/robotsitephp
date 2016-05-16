<?php 

namespace Models\DAO;

use App\Utility\Debug as Debug;

abstract class AbstractDAO{

	public abstract function getById($id);

	public abstract function getAll();

	public abstract function create($object);

	public abstract function update($object);

	public abstract function delete($id);

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
	
  	public function getSettersFromClass($class){
  		$class = new $class;
  		return $class->getSetters();
    }
    
	//testejar.
    public function ObjectToInt($object)
    {
    	$id = null;
        foreach ($object as $key => $value) {
        	if (is_object($value)) {
        		$id = $value->getId();
        		$setter ="set".$key;
        		$object->$setter($id);
        	}
		}
		return $object;
    }

}


?>