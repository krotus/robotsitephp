<?php 

namespace Models\DAO;

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

	public function get(){
		$dao = buildDAO();
		$dao->getById($this->getId());
	}

	public function getAll(){
		$dao = buildDAO();
		$dao->getAll();
	}

	public function create(){
		$dao = buildDAO();
		$dao->create($this);
	}

	public function delete(){
		$dao = buildDAO();
		$dao->delete($this->getId());
	}

	public function update(){
		$dao = buildDAO();
		$dao->update($this);
	}

}

?>