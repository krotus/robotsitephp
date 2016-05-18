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

class ProfileController extends Controller {

    private $admin;

    public function index() {
        View::to("admin.profile");
    }

    public function edit($id) {
        
    }

    public function delete($id) {
        
    }

    public function create() {
        
    }

}

?>