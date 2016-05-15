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
use Respect\Validation\Validator as v;

class WorkerController extends Controller {

    private $worker;

    public function index() {
        View::to("admin.worker.index");
    }

    public function edit($id) {
        View::to("admin.worker.edit");
    }

    public function delete($id) {
        View::to("admin.worker.delete");
    }

    public function create() {
        if(!$_POST){
            $team = new Team();
            $teams = $team->getAll();
            //exit;
            View::to("admin.worker.create", compact('teams'));
        }else{
            $error = "";
            $username = $_POST["worker_username"];
            if(v::notEmpty()->validate($username)){
                $password = $_POST["worker_password"];
                if(v::notEmpty()->validate($password)){
                    $rePassword = $_POST["worker_re_password"];
                    if(v::equals($password)->validate($rePassword)){
                        $nif = $_POST["worker_NIF"];
                        if(v::notEmpty()->validate($nif)){
                            if(v::IdentityCardEs()->validate($nif)){
                                $name = $_POST["worker_name"];
                                if(v::notEmpty()->validate($name)){
                                    $surname = $_POST["worker_surname"];
                                    if(v::notEmpty()->validate($surname)){
                                        $telephone = $_POST["worker_telephone"];
                                        if(v::length(9,null)->validate($telephone)){
                                            $category = $_POST["worker_category"];
                                            if(v::notEmpty()->validate($category)){
                                                $teamId = $_POST["worker_team"];
                                                if(v::notEmpty()->validate($teamId)){
                                                    $isAdmin = $_POST["worker_is_admin"];
                                                    if(v::notEmpty()->validate($isAdmin)){

                                                    }else{
                                                        $error = "select is/not admin";
                                                    }
                                                }else{
                                                    $error = "empty team";
                                                }
                                            }else{
                                                $error = "empty category";
                                            }
                                        }else{
                                            $error = "incorrect telephone";
                                        }
                                    }else{
                                        $error = "empty surname";
                                    }
                                }else{
                                    $error = "empty name";
                                }
                            }else{
                                $error = "nif incorrect";
                            }
                        }else{
                            $error = "empty nif";
                        }
                    }else{
                        $error = "passwords not match";
                    }
                }else{
                    $error = "empty password";
                }
            }else{
                $error = "empty username";
            }

            if(v::notEmpty()->validate($error)){
                View::redirect("admin.worker.create", compact('error'));
            }else{
                echo "create worker";
            }

        }
    }

}

?>