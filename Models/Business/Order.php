<?php

namespace Models\Business;

class Order {
    private $id;
    private $code;
    private $description;
    private $priority;
    private $date;
    private $quantity;
    private $statusOrder;
    private $robot;
    private $process;
    
    
    function __construct($id = null, $code = null, $description = null, $priority = null, 
            $date = null, $quantity = null, $statusOrder = null, $robot = null, $process = null) {
        $this->setCode($code);
        $this->setDescription($description);
        $this->setPriority($priority);
        $this->setDate($date);
        $this->setQuantity($quantity);
        $this->setStatusOrder($statusOrder);
        $this->setRobot($robot);
        $this->setProcess($process);
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

    function getPriority() {
        return $this->priority;
    }

    function getDate() {
        return $this->date;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getStatusOrder() {
        return $this->statusOrder;
    }

    function getRobot() {
        return $this->robot;
    }

    function getProcess() {
        return $this->process;
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

    function setPriority($priority) {
        $this->priority = $priority;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setStatusOrder($statusOrder) {
        $this->statusOrder = $statusOrder;
    }

    function setRobot($robot) {
        $this->robot = $robot;
    }

    function setProcess($process) {
        $this->process = $process;
    }


}
