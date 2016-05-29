<?php

namespace Controllers\Admin;

use Models\Business\Worker as Worker;
use Models\Business\StatusOrder as StatusOrder;
use Models\Business\Admin as Admin;
use Models\Business\Team as Team;
use Models\Business\Order as Order;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;
use App\Utility\PdfCustom as PdfCustom;

/**
 * Classe controladora de les diferents estadístiques que es puguin generar a partir dels seus respectius filtres.
 * Hereta de la classe Controller
 * @package \Controllers\Admin
 */
class StadisticController {

    /**
     * No s'utilitza.
     */
    public function index() {
        View::to("admin.stadistic.index");
    }

    /**
     * llistar detall de les ordres segons un període a demanar (data o mes o
     * any), per treballador o equip, per estat...
     * @return void
     */
    public function table() {
        $team = new Team();
        $teams = $team->getAll();
        $worker = new Worker();
        $workers = $worker->getAll();
        $statusOrder = new StatusOrder();
        $statusOrders = $statusOrder->getAll();
        View::to("admin.stadistic.table", compact('teams', 'workers', 'statusOrders'));
    }

    /**
     * Treballadors, equips amb més/menys ordres completades per període
     * @return void
     */
    public function graphic() {
        View::to("admin.stadistic.graphic");
    }

    /**
     * Petició ajax en el qual retorna en format json la llista d'equips
     * @return string Objecte json amb la llista d'equips
     */
    public function getTeamsAjax() {
        ob_end_clean();
        $team = new Team();
        $teams = $team->getAll();
        $array = array();
        foreach ($teams as $team) {
            array_push($array, $team->objectToArray($team));
        }
        echo json_encode($array);
    }

    /**
     * Petició ajax en el qual retorna en format json la llista de treballadors
     * @return string Objecte json amb la llista de treballadors
     */
    public function getWorkersAjax() {
        ob_end_clean();
        $worker = new Worker();
        $workers = $worker->getAll();
        $array = array();
        foreach ($workers as $worker) {
            array_push($array, $worker->objectToArray($worker));
        }
        echo json_encode($array);
    }

    /**
     * Petició ajax encarregada de enviar per post els filtres passats a partir de la vista
     * en el model per tal de generar el filtre dessitjat, entre periodes.
     * @return string Objecte json amb la llista filtrada.
     */
    public function getStadisticOrdersByAjax() {
        ob_end_clean();
        $strDate = $_POST['str_date'];
        $endDate = $_POST['end_date'];
        $idTeam = intval($_POST['id_team']);
        $idWorker = intval($_POST['id_worker']);
        $idStatus = intval($_POST['id_status']);
        $paramsArray = array(
        "strDate" => $strDate,
        "endDate" => $endDate,
        "idTeam" => $idTeam,
        "idWorker" => $idWorker,
        "idStatus" => $idStatus
        );
        $order = new Order();
        $orders = $order->getStadisticOrders($paramsArray);

        $arrayToSend = array();
        for ($i = 0; $i < count($orders); $i++) {
            $auxArray = array();
            foreach ($orders[$i] as $nOrder) {
                array_push($auxArray, $nOrder);
            }
            array_push($arrayToSend, $auxArray);
        }

        echo json_encode($arrayToSend);
    }

    //TODO
    public function getPdfbyAjax(){
        ob_end_clean();
        $header = $_POST["headers"];
        $rows = $_POST["counts"];
        $pdf = new PdfCustom();
        $pdf->AliasNbPages();
        $pdf->Open();
        $pdf->AddPage();
        $pdf->SetTitle('PDF A IMPRIMIR');
        $pdf->SetMargins(10,5,5);
        $pdf->SetDisplayMode(93);
        $pdf->Ln(5);
        
        $pdf->ImprovedTable($header,array($rows));
        $pdf->Output();
    }

}

?>