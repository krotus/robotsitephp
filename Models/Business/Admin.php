<?php

namespace Models\Business;

use Models\Business\User as User;
use Models\DAO\TaskDAO as TaskDAO;

/**
 * Classe Admin que hereta de User i que te privilegis per realitzar operacions CRUD sobre qualsevol model.
 * @package \Models\Business\Admin
 */
class Admin extends User {

    public function __construct($id = null, $username = null, $password = null, $nif = null, $name = null, $surname = null, $mobile = null, $telephone = null, $category = null, $team = null, $isAdmin = null, $language = null) {
        parent::__construct($id, $username, $password, $nif, $name, $surname, $mobile, $telephone, $category, $team, 1, $language);
        $this->setIsAdmin(1);
    }

    /**
     * Metode que assigna una ordre a un equip mitjançant una tasca.
     * @param type $task
     */
    public function assignOrderToTeam($task) {
        $dao = new TaskDAO;
        $dao->create($task);
    }

    /**
     * Ens permet reasignar una ordre a partir de la tasca.
     * @param object $task 
     */
    public function reassignOrder($task) {
        $dao = new TaskDAO;
        $dao->update($task);
    }

    /**
     * Metode que crea un nou treballador.
     * @param object $worker
     */
    public function createWorker($worker) {
        $worker->create();
    }

    /**
     * Metode que actualitza el treballador que li donem.
     * @param object $worker
     */
    public function updateWorker($worker) {
        $worker->update();
    }

    /**
     * Metode que crea un nou equip.
     * @param object $team
     */
    public function createTeam($team) {
        $team->create();
    }

    /**
     * Metode que actualitza el equip que li passem.
     * @param object $team
     */
    public function updateTeam($team) {
        $team->update();
    }

    /**
     * Aquest metode crea un robot.
     * @param object $robot
     */
    public function createRobot($robot) {
        $robot->create();
    }

    /**
     * Metode que actualitza un robot a partir de l'objecte robot que l'hi enviem.
     * @param object $robot
     */
    public function updateRobot($robot) {
        $robot->update();
    }

    /**
     * Metode que crea un procés.
     * @param object $process
     */
    public function createProcess($process) {
        $process->create();
    }

    /**
     * Metode el qual actualitza un procés a partir d'un objecte d'aquest mateix.
     * @param object $process
     */
    public function updateProcess($process) {
        $process->update();
    }

    /**
     * Metode que crea una ordre.
     * @param object $order
     */
    public function createOrder($order) {
        $order->create();
    }

    /**
     * Aquest metode actualitza una ordre a partir d'un objecte del mateix tipus.
     * @param type $order
     */
    public function updateOrder($order) {
        $order->update();
    }

    /**
     * Metode que crea una nova tasca.
     * @param object $task
     */
    public function createTask($task) {
        $task->create();
    }

    /**
     * Metode que actualitza una tasca a partir d'un obejecte d'aquest mateix.
     * @param object $task
     */
    public function updateTask($task) {
        $task->update();
    }

}

?>
