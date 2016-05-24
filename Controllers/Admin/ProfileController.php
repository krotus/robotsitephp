<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Language as Language;
use Models\Business\Admin as Admin;
use Models\Business\Team as Team;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\QuickForm as QuickForm;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

class ProfileController extends Controller {

    private $admin;

    public function index() {
        if (!$_POST) {
            $admin = unserialize(Session::get('user'));

            $team = new Team();
            $teams = $team->getAll();
            $language = new Language();
            $languages = $language->getAll();
            View::to("admin.profile", compact('admin', 'teams', 'languages'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'worker_username' => $_POST["worker_username"],
                'worker_password' => $_POST["worker_password"],
                'worker_re_password' => $_POST["worker_re_password"],
                'worker_nif' => $_POST["worker_nif"],
                'worker_name' => $_POST["worker_name"],
                'worker_surname' => $_POST["worker_surname"],
                'worker_mobile' => $_POST["worker_mobile"],
                'worker_telephone' => $_POST["worker_telephone"],
                'worker_category' => $_POST["worker_category"],
                'worker_team' => $_POST["worker_team"]
            );
            $rules = array(
                'worker_username' => 'required|alpha_numeric|min_len,3',
                'worker_password' => 'required|max_len,50|min_len,3',
                'worker_re_password' => 'required|equalsfield,worker_password',
                'worker_nif' => 'required|valid_nif',
                'worker_name' => 'required|max_len,50|min_len,3',
                'worker_surname' => 'required|max_len,50|min_len,3',
                'worker_mobile' => 'required|numeric|exact_len,9',
                'worker_telephone' => 'required|numeric|exact_len,9',
                'worker_category' => 'required|max_len,50|min_len,3',
                'worker_team' => 'required'
            );
            $validated = $validator->validate($inputs, $rules);

            if ($validated === TRUE) {
                $admin = unserialize(Session::get("user"));
                $nAdmin = new Admin(
                        $admin->getId(), 
                        $_POST["worker_username"], 
                        $_POST["worker_password"], 
                        $_POST["worker_nif"], 
                        $_POST["worker_name"], 
                        $_POST["worker_surname"], 
                        $_POST["worker_mobile"], 
                        $_POST["worker_telephone"], 
                        $_POST["worker_category"], 
                        $_POST["worker_team"],
                        1, //isAdmin
                        $_POST["worker_language"] //code language
                );

                $admin->updateWorker($nAdmin);
                
                $team = new Team($_POST["worker_team"]);
                $team = $team->get();
                $nAdmin->setTeam($team);

                $language = new Language($_POST["worker_language"]);
                $language = $language->get();
                $nAdmin->setLanguage($language);

                Session::set('user', serialize($nAdmin));
                $msg = "s'ha editat satisfactoriament.";
                View::redirect("admin.dashboard", compact("msg"));
            } else {
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.profile", compact('error'));
            }
        }
    }

    public function edit($id) {
        
    }

    public function delete($id) {
        
    }

    public function create() {
        
    }

}

?>