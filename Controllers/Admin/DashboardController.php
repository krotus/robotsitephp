<?php 

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Team as Team;
use Models\Business\Robot as Robot;
use Models\Business\Task as Task;
use Models\Business\Order as Order;
use Models\Business\Process as Process;
use Models\Business\Admin as Admin;
use App\Core\Session as Session;
use App\Core\View as View;

/**
 * Classe controladora del dasbhoard sobre el que interactua l'administrador.
 * @package \Controllers\Admin
 */
class DashboardController extends Controller{

	/**
	 * Metode index en el que es renderitza la vista principal del panell de control.
	 * Juntament amb els dades més rellevants de cada item.
	 * @return void
	 */
	public function index(){
		$worker = new Worker();
		$workers = count($worker->getAll());

		$team = new Team();
		$teams = count($team->getAll());

		$robot = new Robot();
		$robots = count($robot->getAll());

		$task = new Task();
		$tasks = count($task->getAll());

		$order = new Order();
		$orders = count($order->getAll());

		$process = new Process();
		$processes = count($process->getAll());

        View::to(
        	"admin.dashboard.index", 
        	compact('workers','teams','robots','tasks','orders','processes')
        	);
	}

	/**
	 * No s'utilitza.
	 */
	public function edit($id){}

	/**
	 * No s'utilitza.
	 */
	public function delete($id){}

	/**
	 * No s'utilitza.
	 */
	public function create(){}

}

?>