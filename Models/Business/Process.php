<?php

namespace Models\Business;

use Models\DAO\DataObject as DataObject;

class Process extends DataObject{
    private $id;
    private $code;
    private $description;
    
    function __construct($id = null, $code = null, $description = null) {
        $this->setCode($code);
        $this->setDescription($description);
    }

    
    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setDescription($description) {
        $this->description = $description;
    }


}
