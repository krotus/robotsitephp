<?php

namespace Models\DAO;

use App\Utility\Debug as Debug;

abstract class DataObject {

    public function get() {
        $typeOf = get_class($this);
        $typeOf = str_replace("Business", "DAO", $typeOf);
        $typeOf .= "DAO";
        $dao = new $typeOf;
        $dao->getById($this->getId());
    }

    public function getAll() {
        
    }

    public function add($object) {
        
    }

    public function delete($object) {
        
    }

    public function update($object) {
        
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