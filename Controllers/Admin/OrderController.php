<?php

namespace Controllers\Admin;

use Controllers\Controller as Controller;
use Models\Business\Process as Process;
use Models\Business\Robot as Robot;
use Models\Business\Order as Order;
use Models\Business\Admin as Admin;
use App\Core\Session as Session;
use App\Core\View as View;
use App\Utility\Debug as Debug;
use Wixel\Gump\GUMP as Gump;

class OrderController extends Controller {

    private $order;

    public function index() {
        View::to("admin.order.index");
    }

    public function edit($id) {
        if(!$_POST){
            $order = new Order($id);
            $order = $order->get();
            View::to("admin.order.edit", compact('order'));
        } else {
            $validator = new Gump();
            $inputs = array(
                'process_code'              =>  $_POST["process_code"],
                'process_description'       =>  $_POST["process_description"],
            );
            $rules = array(
                'process_code'              =>  'required|numeric|min_len,3',
                'process_description'       =>  'required|max_len,50|min_len,3',
            );
            $validated = $validator->validate($inputs, $rules);
            
            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->updateOrder(new Order(
                    $id,
                    $_POST["process_code"],
                    $_POST["process_description"]
                    ));
                $msg = "s'ha editat satisfactoriament.";
                View::redirect("admin.order", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.order.edit.".$id, compact('error'));
            }
        }
    }

    public function delete($id) {
        View::to("admin.order.delete");
    }

    public function create() {
        if(!$_POST){
            $robot = new Robot();
            $robots = $robot->getAll();
            $process = new Process();
            $processes = $process->getAll();
            View::to("admin.order.create", compact('robots','processes'));
        }else{
            $validator = new Gump();
            $inputs = array(
                'order_code'              =>  $_POST["order_code"],
                'order_description'       =>  $_POST["order_description"],
                'order_priority'          =>  $_POST["order_priority"],
                'order_quantity'          =>  $_POST["order_quantity"],
                'orden_robot'             =>  $_POST["orden_robot"],
                'orden_proceso'           =>  $_POST["orden_proceso"]
            );
            $rules = array(
                'order_code'              =>  'required|numeric|min_len,3',
                'order_description'       =>  'required|max_len,50|min_len,3',
                'order_priority'          =>  'required',
                'order_quantity'          =>  'required|numeric|min_len,1',
                'orden_robot'             =>  'required',
                'orden_proceso'           =>  'required'
            );
            $validated = $validator->validate($inputs, $rules);

            if($validated === TRUE){
                $admin = unserialize(Session::get("user"));
                $admin->createOrder(new Order(
                    null,
                    $_POST["order_code"],
                    $_POST["order_description"],
                    $_POST["order_priority"],
                    null,//date des del sql
                    $_POST["order_quantity"],
                    1,//statusOrder "pending"
                    $_POST["orden_robot"],
                    $_POST["orden_proceso"]
                    ));
                $msg = "s'ha creat satisfactoriament.";
                View::redirect("admin.order", compact("msg"));
            }else{
                $error = $validator->get_readable_errors(false);
                View::redirect("admin.order.create", compact('error'));
            }
        }
    }

}

?>