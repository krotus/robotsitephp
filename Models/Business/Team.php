<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;
use Models\DAO\TeamDAO as TeamDAO;

/**
 * Classe Team, hereta de DataObject i permet gestionar el CRUD de la taula teams a partir 
 * dels seus metodes i atributs.
 * @package \Models\Business
 */
class Team extends DataObject {

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

    /**
     * Metode que retorna tots els equips
     * @return array[][]
     */
    public function getAllTeamsAdmin() {
        $dao = new TeamDAO();
        return $dao->getAllTeamsAdmin();
    }

}
