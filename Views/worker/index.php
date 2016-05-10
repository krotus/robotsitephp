<?php
if (isset($data)) {
    if (array_key_exists("alert", $data)) {
        echo '<div class="alert alert-danger" role="alert">' . $trans[$data["alert"]] . '</div>';
    }
}
?>
<h2><?php
    //echo $trans['title'];
    echo "Ordenes de " . $data["marc"]
    ?></h2>
<!--<a href="<?php echo URL . 'worker/language' ?>">switch language</a>-->
<div class="row">
    <div class="col-md-1 hidden-xs">
    </div>
    <div class="panel panel-primary col-md-10 col-xs-12">
        <div class="panel-heading">
            <h3 data-toggle="collapse" data-parent="#accordion" href="#collapse1">Ordenes pendientes</h3>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body"> <table id="pending-ord" class="orders-table table table-striped table-bordered"></table></div>
        </div>
    </div>
    <div class="col-md-1 hidden-xs">
    </div>
</div>

<div class="row">
    <div class="col-md-1 hidden-xs">
    </div>
    <div class="panel panel-primary col-md-10 col-xs-12">
        <div class="panel-heading">
            <h3 data-toggle="collapse" data-parent="#accordion" href="#collapse2">Ordenes inicializadas</h3>
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
        <div class="panel-heading">
            <h3 data-toggle="collapse" data-parent="#accordion" href="#collapse3">Ordenes completadas</h3>
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
        <div class="panel-heading">
            <h3 data-toggle="collapse" data-parent="#accordion" href="#collapse4">Ordenes no completadas</h3>
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
        <div class="panel-heading">
            <h3 data-toggle="collapse" data-parent="#accordion" href="#collapse5">Ordenes canceladas</h3>
        </div>
        <div id="collapse5" class="panel-collapse collapse ">
            <div class="panel-body"> <table id="cancelled-ord" class="orders-table table table-striped table-bordered"></table></div>
        </div>
    </div>
    <div class="col-md-1 hidden-xs">
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        pendingOrders();
        initOrders();
        completedOrders();
        uncompletedOrders();
        cancelledOrders();
    });
</script>