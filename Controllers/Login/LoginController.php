<?php

namespace Controllers\Login;

use App\Core\View as View;
use App\Core\Session as Session;
use App\Core\Cookie as Cookie;
use Models\Business\Worker as Worker;
use Models\Business\Admin as Admin;
use Models\Business\User as User;
use App\Utility\Debug as Debug;


/**
 * Classe controladora del login sobre el que interactua qualsevol usuari que intenti accedir a la plataforma web.
 * @package \Controllers\Admin
 */
class LoginController {

    /**
     * Es renderitza una primera vista amb dos camps, usuari i contrasenya en els que es realitzar les validacions pertinents per
     * evaluar si forma part d'un membre de l'empresa, sigui equip o treballador.
     * En cada cas es generarà una sessió on viura fins que es tanqui l'aplicació i depenen del tipus de usuari
     * es redirigirà a una secció diferent de l'aplicació.
     * @return void
     */
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
                if(isset($_POST["remember-me"])){
                    Cookie::set("username", $_POST["login-user"]);
                    Cookie::set("password", $_POST["login-password"]);
                }else{
                    Cookie::destroy("username");
                    Cookie::destroy("password");
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
