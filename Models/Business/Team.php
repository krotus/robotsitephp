<?php

namespace Models\Business;

class Team {
    private $id;
    private $code;
    private $name;
    
    function __construct($id = null, $code = null, $name = null) {
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
