<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;

class Team extends DataObject{
    protected $id;
    protected $code;
    protected $name;
    
    function __construct($id = null, $code = null, $name = null) {
        $this->setId($id);
        $this->setCode($code);
        $this->setName($name);
    }

    
    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getName() {
        return $this->name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setName($name) {
        $this->name = $name;
    }


}
