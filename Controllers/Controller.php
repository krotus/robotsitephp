<?php 

namespace Controllers;

use App\Core\Session as Session;
use App\Core\View as View;

/**
 * Classe abstracta Controllers, utilitzada per dictamina unes regles i patrons a la resta de controladors que l'heretan.
 * @package \Controllers
 * @method void index()
 * @method void edit(integer $id)
 * @method void delete(integer $id)
 * @methood void create()
 */
abstract class Controller{

	abstract protected function index();
	abstract protected function edit($id);
	abstract protected function delete($id);
	abstract protected function create();

	public function logout(){
		Session::destroy("user");
        View::redirect("login.index");
	}
}

?>