<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;

class Robot extends DataObject{
    private $id;
    private $code;
    private $name;
    private $ipAddress;
    private $latitude;
    private $longitude;
    private $statusRobot;
    
    function __construct($id = null, $code = null, $name = null, $ipAddress = null, 
            $latitude = null, $longitude = null, $statusRobot = null) {
        $this->setCode($code);
        $this->setName($name);
        $this->setIpAddress($ipAddress);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setStatusRobot($statusRobot);
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

    function getIpAddress() {
        return $this->ipAddress;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function getStatusRobot() {
        return $this->statusRobot;
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

    function setIpAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    function setStatusRobot($statusRobot) {
        $this->statusRobot = $statusRobot;
    }


}
