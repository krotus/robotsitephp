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

class TeamController extends Controller {

    private $team;

    public function index() {
        View::to("admin.team.index");
    }

    public function edit($id) {
        if(!$_POST){
        $team = new Team($id);
        $team = $team->get();
        View::to("admin.team.edit", compact('team'));
        }else{
            $validator = new Gump();
            $inputs = array(
                'team_code'       =>  $_POST["team_code"],
                'team_name'       =>  $_POST["team_name"]
            );
            $rules = array(
                'team_code'       =>  'required|numeric|min_len,3',
                'team_name'       =>  'required|max_len,50|min_len,3',
            );
            $validated = $validator->validate($inputs, $rules);

            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->updateTeam(new Team(
                    null,
                    $_POST["team_code"],
                    $_POST["team_name"]
                    ));
                $msg = "S'ha creat satisfactoriament.";
                View::redirect("admin.team", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.team.edit.". $id, compact('error'));
            }
        }
    }

    public function delete($id) {
        View::to("admin.team.delete");
    }

    public function create() {
        if(!$_POST){
            View::to("admin.team.create");
        }else{
            $validator = new Gump();
            $inputs = array(
                'team_code'       =>  $_POST["team_code"],
                'team_name'       =>  $_POST["team_name"]
            );
            $rules = array(
                'team_code'       =>  'required|numeric|min_len,3',
                'team_name'       =>  'required|max_len,50|min_len,3',
            );
            $validated = $validator->validate($inputs, $rules);

            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->createTeam(new Team(
                    null,
                    $_POST["team_code"],
                    $_POST["team_name"]
                    ));
                $msg = "S'ha creat satisfactoriament.";
                View::redirect("admin.team", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.team.create", compact('error'));
            }
        }
    }

}

?>