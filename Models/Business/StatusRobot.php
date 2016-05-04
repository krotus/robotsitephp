<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusRobot
 *
 * @author Marc
 */
class StatusRobot {
    private $id;
    private $description;
    
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
