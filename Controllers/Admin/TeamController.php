<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Worker as Admin;
use Models\Business\Team as Team;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\QuickForm as QuickForm;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;


/**
 * Classe controladora dels equips que formen l'aplicació.
 * Hereta de la classe Controller
 * @package \Controllers\Admin
 */
class TeamController extends Controller {

    /**
     * Metode index en el que es renderitza una llista de equips actuals amb opció de reordanament manual entre camps.
     * @return void
     */
    public function index() {
        View::to("admin.team.index");
    }


    /**
     * Metode edit en el que a partir de la id única del equip podrem actualitza el registre de la taula equips utilitzant la capa de model.
     * També realitza una serie de validacions per tal de que els camps que es recuperen sigin valids per la generació del objecte.
     * @param integer $id La id que identifica de forma única al registre
     * @return void
     */
    public function edit($id) {
        if (!$_POST) {
            $team = new Team($id);
            $team = $team->get();
            $teamAll = new Team();
            $teamCode = $team->getCode();
            $teams = $teamAll->getAll();
            $codeTeams = [];
            foreach ($teams as $nTeam){
                if($nTeam->getCode() != $teamCode){
                    $codeTeams[] = $nTeam->getCode();
                }
            }
            View::to("admin.team.edit", compact('team', 'codeTeams'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'team_code' => $_POST["team_code"],
                'team_name' => $_POST["team_name"]
            );
            $rules = array(
                'team_code' => 'required|numeric|min_len,3',
                'team_name' => 'required|max_len,50|min_len,3',
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $admin = unserialize(Session::get("user"));
                $admin->updateTeam(new Team(
                        $id, $_POST["team_code"], $_POST["team_name"]
                ));

                $msg = "S'ha editat satisfactoriament.";
                View::redirect("admin.team", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.team.edit." . $id, compact('error'));
            }
        }
    }

    /**
     * Metode delete, elimina un equip a partir de la seva id, ordena al model a eliminar el registre.
     * @param type $id La id identifica de forma única al registre
     * @return void
     */
    public function delete($id) {
        $team = new Team($id);
        $team->delete();
    }


    /**
    * Metode create, renderitza un formulari on a partir de camps que li ariven com a parametres POST, crida al model per crear-ne'n l'objecte
    * i finalment grabar-lo a la base de dades si aquest, es correcte.
    * @return void
    */
    public function create() {
        if (!$_POST) {
            $team = new Team();
            $teams = $team->getAll();
            $codeTeams = [];
            foreach ($teams as $team){
                $codeTeams[] = $team->getCode();
            }
            View::to("admin.team.create", compact('codeTeams'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'team_code' => $_POST["team_code"],
                'team_name' => $_POST["team_name"]
            );
            $rules = array(
                'team_code' => 'required|numeric|min_len,3',
                'team_name' => 'required|max_len,50|min_len,3',
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $admin = unserialize(Session::get("user"));
                $admin->createTeam(new Team(
                        null, $_POST["team_code"], $_POST["team_name"]
                ));
                $msg = "S'ha creat satisfactoriament.";
                View::redirect("admin.team", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.team.create", compact('error'));
            }
        }
    }


    /**
     * Metode getTeamsByAjax que es cridat per una petició Ajax sobre els equips de la base de dades.
     * Utilitzat per la generació de les taules dinamiques que es troben al metode index.
     * En aquest cas un recull els equips a partir del model.
     * @return string Objecte json amb totes els equips de la tels equips.
     */
    function getTeamsByAjax() {
        ob_end_clean();
        $team = new Team();
        $teams = $team->getAllTeamsAdmin();
        $arrayToSend = array();
        for ($i = 0; $i < count($teams); $i++) {
            $auxArray = array();
            foreach ($teams[$i] as $nTeam) {
                array_push($auxArray, $nTeam);
            }
            array_push($auxArray, "<a href='" . URL . "admin/team/edit/" . $teams[$i]['id'] . "'><button class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></a><button class='btn btn-danger' onclick='deleteTeam(" . $teams[$i]['id'] . ", \"" . URL . "\");'><span class='glyphicon glyphicon-remove'></span></button>");
            array_shift($auxArray);
            array_push($arrayToSend, $auxArray);
        }
        echo json_encode($arrayToSend);
    }

}

?>