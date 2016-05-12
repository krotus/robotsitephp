<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Worker as Worker;
use Models\Business\Worker as Admin;
use App\Core\Session as Session;
use App\Core\View as View;

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
        View::to("admin.worker.create");
    }

}

?>