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
use App\Utility\FormValidator as FormValidator;
use Wixel\Gump\GUMP as Gump;

class TeamController extends Controller {

    private $team;

    public function index() {
        View::to("admin.team.index");
    }

    public function edit($id) {
        View::to("admin.team.edit");
    }

    public function delete($id) {
        View::to("admin.team.delete");
    }

    public function create() {
        if(!$_POST){
            $team = new Team();
            $teams = $team->getAll();
            View::to("admin.team.create");
        }else{
            $validator = new Gump();
            $inputs = array(
                'worker_username'       =>  $_POST["worker_username"],
                'worker_password'       =>  $_POST["worker_password"],
                'worker_re_password'    =>  $_POST["worker_re_password"],
                'worker_nif'            =>  $_POST["worker_nif"],
                'worker_name'           =>  $_POST["worker_name"],
                'worker_surname'        =>  $_POST["worker_surname"],
                'worker_telephone'      =>  $_POST["worker_telephone"],
                'worker_category'       =>  $_POST["worker_category"],
                'worker_team'           =>  $_POST["worker_team"],
                'worker_is_admin'       =>  $_POST["worker_is_admin"]
            );
            $rules = array(
                'worker_username'       =>  'required|alpha_numeric|min_len,3',
                'worker_password'       =>  'required|max_len,50|min_len,3',
                'worker_re_password'    =>  'required|equalsfield,worker_password',
                'worker_nif'            =>  'required|valid_nif',
                'worker_name'           =>  'required|max_len,50|min_len,3',
                'worker_surname'        =>  'required|max_len,50|min_len,3',
                'worker_telephone'      =>  'required|numeric|exact_len,9',
                'worker_category'       =>  'required|max_len,50|min_len,3',
                'worker_team'           =>  'required',
                'worker_is_admin'       =>  'required',
            );
            $validated = $validator->validate($inputs, $rules);

            if($validated === TRUE){
                echo "create worker";
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.team.create", compact('error'));
            }
        }
    }

}

?>