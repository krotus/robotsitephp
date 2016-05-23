<?php

namespace Controllers\Admin;

use Models\Business\Worker as Worker;
use Models\Business\StatusOrder as StatusOrder;
use Models\Business\Admin as Admin;
use Models\Business\Team as Team;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

class StadisticController {

    public function index() {
        View::to("admin.stadistic.index");
    }


    // llistar detall de les ordres segons un període a demanar (data o mes o
    // any), per treballador o equip, per estat...
    public function table(){
        $team = new Team();
        $teams = $team->getAll();
        $worker = new Worker();
        $workers = $worker->getAll();
        $statusOrder = new StatusOrder();
        $statusOrders = $statusOrder->getAll();
        View::to("admin.stadistic.table",compact('teams','workers','statusOrders'));
    }

    //treballadors, equips amb més/menys ordres completades per període
    public function graphic(){
        View::to("admin.stadistic.graphic");
    }

    public function getTeamsAjax(){
        ob_end_clean();
        $team = new Team();
        $teams = $team->getAll();
        $array = array();
        foreach ($teams as $team) {
            array_push($array, $team->objectToArray($team));
        }
        echo json_encode($array);
    }

    public function getWorkersAjax(){
        ob_end_clean();
        $worker = new Worker();
        $workers = $worker->getAll();
        $array = array();
        foreach ($workers as $worker) {
            array_push($array, $worker->objectToArray($worker));
        }
        echo json_encode($array);
    }

}

?>