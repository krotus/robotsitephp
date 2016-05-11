<?php

namespace Models\Business;

use Models\Business\DataObject as DataObject;

class Task extends DataObject{
    protected $id;
    protected $team;
    protected $order;
    protected $worker;
    protected $dateAssignation;
    protected $dateCompletion;
    protected $justification;
    
    function __construct($id = null, $team = null, $order = null, $worker = null, 
            $dateAssignation = null, $dateCompletion = null, $justification = null) {
        $this->team = $team;
        $this->order = $order;
        $this->worker = $worker;
        $this->dateAssignation = $dateAssignation;
        $this->dateCompletion = $dateCompletion;
        $this->justification = $justification;
    }

    
    function getId() {
        return $this->id;
    }

    function getTeam() {
        return $this->team;
    }

    function getOrder() {
        return $this->order;
    }

    function getWorker() {
        return $this->worker;
    }

    function getDateAssignation() {
        return $this->dateAssignation;
    }

    function getDateCompletion() {
        return $this->dateCompletion;
    }

    function getJustification() {
        return $this->justification;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTeam($team) {
        $this->team = $team;
    }

    function setOrder($order) {
        $this->order = $order;
    }

    function setWorker($worker) {
        $this->worker = $worker;
    }

    function setDateAssignation($dateAssignation) {
        $this->dateAssignation = $dateAssignation;
    }

    function setDateCompletion($dateCompletion) {
        $this->dateCompletion = $dateCompletion;
    }

    function setJustification($justification) {
        $this->justification = $justification;
    }


}
