<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;

/**
 * Classe StatusOrder, hereta de DataObject i permet gestionar el CRUD de la taula status_order a partir 
 * dels seus metodes i atributs.
 * @package \Models\Business
 */
class StatusOrder extends DataObject{
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
