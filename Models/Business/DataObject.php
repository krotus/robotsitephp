<?php 

namespace Models\Business;

use App\Utility\Debug as Debug;

abstract class DataObject{

	private function buildDAO()
	{
		$typeOf = get_class($this);
		$typeOf = str_replace("Business", "DAO", $typeOf);
		$typeOf .= "DAO";
		$dao = new $typeOf;
		return $dao;
	}

	public function arrayToObject($data)
	{
		$setters  = $this->getSetters();
		$typeOf = get_class($this);
		$class = new $typeOf;
		$i = 0;
		foreach ($data as $key => $value) {
			$class->$setters[$i]($value);
			$i++;
		}
		var_dump($class);
		exit;
	}
  	public function getSetters()
    {
        $settersArray = array();
        foreach ($this as $key => $value) {
           $key = ucfirst($key);
           array_push($settersArray,"set" . $key);
        }

        return $settersArray;
    }

	public function get(){
		$dao = $this->buildDAO();
		$obj = $this->arrayToObject($dao->getById($this->getId()));
		return $obj; 
	}

	protected function getAll(){
		$dao = $this->buildDAO();
		return $dao->getAll();
	}

	protected function create(){
		$dao = $this->buildDAO();
		return $dao->create($this);
	}

	protected function delete(){
		$dao = $this->buildDAO();
		return $dao->delete($this->getId());
	}

	protected function update(){
		$dao = $this->buildDAO();
		return $dao->update($this);
	}

    protected function objectToArray($data) {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = objectToArray($value);
            }
            return $result;
        }
        return $data;
    }

}

?>