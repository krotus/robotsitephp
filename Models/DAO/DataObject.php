<?php 

namespace Models\DAO;

use App\Utility\Debug as Debug;

abstract class DataObject{

	public function get(){
		$typeOf = get_class($this);
		$typeOf = str_replace("Business", "DAO", $typeOf);
		$typeOf .= "DAO";
		$dao = new $typeOf;
		$dao->getById($this->id);		
	}

	public function getAll(){

	}

	public function add($object){
		
	}

	public function delete($object){

	}

	public function update($object){

	}

}

?>