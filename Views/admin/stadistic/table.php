<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/datetimepicker-custom.css">
<section class="content-header">
    <h1>
        Estadísticas de las ordenes
        <small>Ordenes segun periodo, trabajador/equipo y estado</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
        	<label for="order_code">Periodo</label>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <div class="col-md-6" style="padding-left: 0px;">
            	<label for="order_code">Inicio:</label>
            	<div class='input-group date' id='datepickerstart'>
        	        <input type='text' class="form-control" id="order_date" name="order_date"/>
        	        <span class="input-group-addon">
        	            <span class="glyphicon glyphicon-calendar"></span>
        	        </span>
        	    </div>
            </div>
            <div class="col-md-6">
            	<label for="order_code">Fin:</label>
            	<div class='input-group date' id='datepickerend'>
        	        <input type='text' class="form-control" id="order_date" name="order_date"/>
        	        <span class="input-group-addon">
        	            <span class="glyphicon glyphicon-calendar"></span>
        	        </span>
        	    </div>
            </div>
        </div>
        <div class="form-group col-md-2 col-xs-12">
            <label for="order_code">Filtro por:</label>
            <select class="selectpicker form-control" onchange="switchFilter(this.value)">
                <option value="empty">Ningun</option>
            	<option value="team">Equipo</option>
            	<option value="worker">Trabajador</option>
            </select>
        </div>
        <div class="form-group col-md-2 col-xs-12">
        	<label for="order_code">&nbsp;</label>
            <select id="select_filter" class="selectpicker form-control">
            	<option> - - - - - - - - - - - - - - </option>
            </select>
        </div>
        <div class="form-group col-md-2 col-xs-12">
            <label for="order_status">Estado:</label>
            <?php
            App\Utility\QuickForm::createSelect("order_status", "description", $data['statusOrders']);
            ?>
        </div>
        <div class="col-xs-12">
            <input type="button" class="btn btn-primary" value="Filtrar" name="filter_order">
        </div>
    </div> <!-- ./row -->
    <div class="row">
        <div class="col-xs-12">
            <table id="ordersFilter" class="table table-bordered table-condensed">
            </table>
        </div>
    </div> <!-- ./row -->
<script type="text/javascript">
    $(document).ready(function(){
    	$('#datepickerstart').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
        $('#datepickerend').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
        ordersListStadistics();
        $("#select_filter").show();
    });
    function switchFilter($valueFilter){
    	switch($valueFilter){
    		case "worker":
               $.getJSON( "<?php echo URL . 'admin/stadistic/getWorkersAjax' ?>", function( workers ) {
                    var select = "";
                    for(var i = 0; i < workers.length; i++){
                        select += "<option value="+workers[i].id+">"+workers[i].username+"</option>";
                    }
                    $("#select_filter").html(select); 
                });
                break;
            case "team":

                $.getJSON( "<?php echo URL . 'admin/stadistic/getTeamsAjax' ?>", function( teams ) {
                    var select = "";
                    for(var i = 0; i < teams.length; i++){
                        select += "<option value="+teams[i].id+">"+teams[i].name+"</option>";
                    }
                    $("#select_filter").html(select);     
                    $("#select_filter").show();     
                });
                break;
            default:
                $("#select_filter").html("<option> - - - - - - - - - - - - - - </option>");  
    			break;
    	}
    }
</script>