<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;

class StatusOrder extends DataObject{
    protected $id;
    protected $description;
    
    function __construct($id = null, $description = null) {
        $this->setDescription($description);
    }

    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($description) {
        $this->description = $description;
    }


}
