<?php

namespace Controllers\Login;

use App\Core\View as View;
use App\Core\Session as Session;
use Models\Business\Worker as Worker;
use Models\Business\Admin as Admin;
use Models\Business\User as User;
use App\Utility\Debug as Debug;

class LoginController {

    public function index() {
        if (!$_POST) {
            View::to("login.index");
        } else {
            $user = new User();
            $user->setUsername($_POST["login-user"]);
            $user->setPassword($_POST["login-password"]);
            if($user->authenticate()){
                if($user->getIsAdmin() == 1){
                    $user = new Admin($user->getId());
                }else{
                    $user = new Worker($user->getId());
                }
                $user = $user->get();
                Session::set("user", serialize($user));
                if($user->getIsAdmin() == 1){
                    View::redirect("admin." . FIRST_PAGE_ADMIN);
                }else{
                    View::redirect(FIRST_PAGE);
                }
            }else{
                $alert = "error_authenticate";
                View::redirect("login.index", compact("alert"));
            }
        }
    }

}

?>
