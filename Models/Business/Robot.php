<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;
use Models\DAO\RobotDAO as RobotDAO;

/**
 * @package \Models\Business\Robot
 */
class Robot extends DataObject {

    protected $id;
    protected $code;
    protected $name;
    protected $ipAddress;
    protected $latitude;
    protected $longitude;
    protected $statusRobot;
    protected $ipCam;

    function __construct($id = null, $code = null, $name = null, $ipAddress = null, $latitude = null, $longitude = null, $statusRobot = null, $ipCam = null) {
        $this->setId($id);
        $this->setCode($code);
        $this->setName($name);
        $this->setIpAddress($ipAddress);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setStatusRobot($statusRobot);
        $this->setIpCam($ipCam);
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

    function getIpCam() {
        return $this->ipCam;
    }

    function setIpCam($ipCam) {
        $this->ipCam = $ipCam;
    }

    /**
     * Metode que agafa tots els robots.
     * @return array[][]
     */
    public function getAllRobotsAdmin() {
        $dao = new RobotDAO();
        return $dao->getAllRobotsAdmin();
    }

}
