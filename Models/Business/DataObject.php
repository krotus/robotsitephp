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

	protected function get(){
		$dao = $this->buildDAO();
		return $dao->getById($this->getId());
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