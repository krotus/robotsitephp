<?php 

namespace Models\Business;

use App\Utility\Debug as Debug;

abstract class DataObject{

	protected function buildDAO(){
		$typeOf = get_class($this);
		$typeOf = str_replace("Business", "DAO", $typeOf);
		$typeOf .= "DAO";
		$dao = new $typeOf;
		return $dao;
	}

  	public function getSetters(){
        $settersArray = array();
        foreach ($this as $key => $value) {
           $key = ucfirst($key);
           array_push($settersArray,"set" . $key);
        }

        return $settersArray;
    }

	public function get(){
		$dao = $this->buildDAO();
		return $dao->getById($this->getId())[0];
	}

	public function getAll(){
		$dao = $this->buildDAO();
		return $dao->getAll();
	}

	public function create(){
		$dao = $this->buildDAO();
		return $dao->create($this);
	}

	public function delete(){
		$dao = $this->buildDAO();
		return $dao->delete($this->getId());
	}

	public function update(){
		$dao = $this->buildDAO();
		return $dao->update($this);
	}

    public function objectToArray($data) {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = $this->objectToArray($value);
                if (is_object($result[$key])) {
                    return $this->objectToArray($result[$key]);
                }
            }
            return $result;
        }
        return $data;
    }

    //testejar.
    public function ObjectToInt($object)
    {
    	$id = null;
        foreach ($object as $key => $value) {
        	if (is_object($value)) {
        		$id = $value->getId();
        		$setter ="set".ucfirst($key);
        		$object->$setter($id);
        	}
		}
		return $object;
    }

}

?>