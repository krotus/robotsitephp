<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;
/**
 * @package \Models\Business\StatusRobot
 */
class StatusRobot extends DataObject{
    protected $id;
    protected $description;
    
    function __construct($id = null, $description = null) {
        $this->setId($id);
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
