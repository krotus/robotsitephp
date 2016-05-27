<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;

/**
 * @package \Models\Business\Point
 */
class Point extends DataObject {

    protected $id;
    protected $posX;
    protected $posY;
    protected $posZ;
    protected $tweezer;
    protected $process;

    function __construct($id = null, $posX = null, $posY = null, $posZ = null, $tweezer = null, $process = null) {
        $this->setId($id);
        $this->setPosX($posX);
        $this->setPosY($posY);
        $this->setPosZ($posZ);
        $this->setTweezer($tweezer);
        $this->setProcess($process);
    }

    function getId() {
        return $this->id;
    }

    function getPosX() {
        return $this->posX;
    }

    function getPosY() {
        return $this->posY;
    }

    function getPosZ() {
        return $this->posZ;
    }

    function getTweezer() {
        return $this->tweezer;
    }

    function getProcess() {
        return $this->process;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPosX($posX) {
        $this->posX = $posX;
    }

    function setPosY($posY) {
        $this->posY = $posY;
    }

    function setPosZ($posZ) {
        $this->posZ = $posZ;
    }

    function setTweezer($tweezer) {
        $this->tweezer = $tweezer;
    }

    function setProcess($process) {
        $this->process = $process;
    }

}
