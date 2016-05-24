<?php
if (isset($data)) {
    if (array_key_exists("alert", $data)) {
        echo '<div class="alert alert-danger" role="alert">' . $data["alert"] . '</div>';
    }
}
?>
<script src="<?php echo URL; ?>public/js/picam.js"></script>
<script src="<?php echo URL; ?>public/js/openCam.js"></script>
<!-- Modal Cam-->
<div id="camModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $trans['title_modal_view_robot']; ?></h4>
            </div>
                <div id="webglviewer"></div>
                <canvas id="tempCanvas" style="width:100%"></canvas>
            <div class="modal-footer">  
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><?php echo $trans['btn_name_cancel']; ?></button>
            </div>
        </div>
    </div>
</div> 
<!-- Modal completed-->
<div id="completedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $trans['title_modal_comp_order']; ?></h4>
            </div>
            <div class="modal-body">
                <span id="order-id-comp" style="display: none;"></span>
                <span id="robot-code-comp" style="display: none;"></span>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker3'>
                        <input id="completed-time" type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker3').datetimepicker({
                            format: 'HH:mm:ss'
                        });
                    });
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" onclick="completeOrder('<?php echo unserialize(\App\Core\Session::get('user'))->getId(); ?>', '<?php echo URL; ?>')"><span class="glyphicon glyphicon-ok"></span></button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
            </div>
        </div>

    </div>
</div>
<!-- Modal cancelled-->
<div id="cancelledModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $trans['title_modal_cancel_order']; ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo $trans['info_modal_cancel_order']; ?></p>
                <span id="order-id-can" style="display: none;"></span>
                <span id="robot-code-can" style="display: none;"></span>
                <div class="form-group">
                    <textarea id="cancel-justification" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" onclick="cancelOrder('<?php echo unserialize(\App\Core\Session::get('user'))->getId(); ?>', '<?php echo URL; ?>')"><span class="glyphicon glyphicon-ok"></span></button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
            </div>
        </div>

    </div>
</div>

<!--Confirmation modal-->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="alert alert-info"></div>
    </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-1 hidden-xs">
        </div>
        <div class="col-md-10 col-xs-12" style="padding-left: 0px">
            <h2>
                <?php echo $trans['title_workers_frontend'] . $data["workerName"]; ?>
            </h2>
        </div>
        <div class="col-md-1 hidden-xs">
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 hidden-xs">
        </div>
        <div class="panel panel-primary col-md-10 col-xs-12">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                <h3><?php echo $trans['title_orders_pending'] ?></h3>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body"> 
                    <table id="pending-ord" class="orders-table table table-bordered table-responsive">
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-1 hidden-xs">
        </div>
    </div>

    <div class="row">
        <div class="col-md-1 hidden-xs">
        </div>
        <div class="panel panel-primary col-md-10 col-xs-12">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                <h3><?php echo $trans['title_orders_init'] ?></h3>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body"> <table id="init-ord" class="orders-table table table-striped table-bordered"></table></div>
            </div>
        </div>
        <div class="col-md-1 hidden-xs">
        </div>
    </div>

    <div class="row">
        <div class="col-md-1 hidden-xs">
        </div>
        <div class="panel panel-primary col-md-10 col-xs-12">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                <h3><?php echo $trans['title_orders_comp'] ?></h3>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body"> <table id="completed-ord" class="orders-table table table-striped table-bordered"></table></div>
            </div>
        </div>
        <div class="col-md-1 hidden-xs">
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 hidden-xs">
        </div>
        <div class="panel panel-primary col-md-10 col-xs-12">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                <h3><?php echo $trans['title_orders_ncomp'] ?></h3>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body"> <table id="uncompleted-ord" class="orders-table table table-striped table-bordered"></table></div>
            </div>
        </div>
        <div class="col-md-1 hidden-xs">
        </div>
    </div>

    <div class="row">
        <div class="col-md-1 hidden-xs">
        </div>
        <div class="panel panel-primary col-md-10 col-xs-12">
            <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                <h3><?php echo $trans['title_orders_cancelled'] ?></h3>
            </div>
            <div id="collapse5" class="panel-collapse collapse ">
                <div class="panel-body"> <table id="cancelled-ord" class="orders-table table table-striped table-bordered"></table></div>
            </div>
        </div>
        <div class="col-md-1 hidden-xs">
        </div>
    </div>
<?php
?>

<script type="text/javascript">
    var lang = "<?php echo unserialize(\App\Core\Session::get('user'))->getLanguage()->getCode(); ?>";
    $(document).ready(function () {
        var idWorker = "<?php echo unserialize(\App\Core\Session::get('user'))->getId(); ?>";
        field1 = "<?php echo $trans['dt_id_order_frontend']; ?>";
        field2 = "<?php echo $trans['dt_code_order_frontend']; ?>";
        field3 = "<?php echo $trans['dt_desc_order_frontend']; ?>";
        field4 = "<?php echo $trans['dt_prio_order_frontend']; ?>";
        field5 = "<?php echo $trans['dt_date_order_frontend']; ?>";
        field6 = "<?php echo $trans['dt_exec_order_frontend']; ?>";
        field7 = "<?php echo $trans['dt_code_robot_frontend']; ?>";
        field8 = "<?php echo $trans['dt_name_robot_frontend']; ?>";
        field9 = "<?php echo $trans['dt_status_robot_frontend']; ?>";
        field10 = "<?php echo $trans['dt_options_frontend']; ?>";

        columns1 = [
                    {title: field1},
                    {title: field2},
                    {title: field3},
                    {title: field4},
                    {title: field5},
                    {title: field6},
                    {title: field7},
                    {title: field8},
                    {title: field9},
                    {title: field10}
                ];
        columns2 = [
                    {title: field1},
                    {title: field2},
                    {title: field3},
                    {title: field4},
                    {title: field5},
                    {title: field6},
                    {title: field7},
                    {title: field8},
                    {title: field9}
                ];

        pendingOrders(idWorker, "<?php echo URL; ?>");
        initOrders(idWorker, "<?php echo URL; ?>");
        completedOrders(idWorker, "<?php echo URL; ?>");
        uncompletedOrders(idWorker, "<?php echo URL; ?>");
        cancelledOrders(idWorker, "<?php echo URL; ?>");
    });
</script>