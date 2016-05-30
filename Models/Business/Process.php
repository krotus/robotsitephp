<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;
use Models\DAO\ProcessDAO as ProcessDAO;

/**
 * Classe Process, hereta de DataObject i permet gestionar el CRUD de la taula processes a partir 
 * dels seus metodes i atributs.
 * @package \Models\Business
 */
class Process extends DataObject {

    protected $id;
    protected $code;
    protected $description;

    function __construct($id = null, $code = null, $description = null) {
        $this->setId($id);
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

    /**
     * Metode que agafa tots el processos
     * @return array[][]
     */
    public function getAllProcessesAdmin() {
        $dao = new ProcessDAO();
        return $dao->getAllProcessesAdmin();
    }

}
