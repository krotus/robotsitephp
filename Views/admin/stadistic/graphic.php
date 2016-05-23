<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/datetimepicker-custom.css">
<section class="content-header">
    <h1>
        Estadísticas de las ordenes
        <small>Trabajadores/equipos con más/menos ordenes completadas por periodo</small>
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
        	        <input type='text' class="form-control" id="order_date_start" name="order_date_start"/>
        	        <span class="input-group-addon">
        	            <span class="glyphicon glyphicon-calendar"></span>
        	        </span>
        	    </div>
            </div>
            <div class="col-md-6">
            	<label for="order_code">Fin:</label>
            	<div class='input-group date' id='datepickerend'>
        	        <input type='text' class="form-control" id="order_date_end" name="order_date_end"/>
        	        <span class="input-group-addon">
        	            <span class="glyphicon glyphicon-calendar"></span>
        	        </span>
        	    </div>
            </div>
        </div>
        <div class="form-group col-md-2 col-xs-12">
            <label for="order_code">Filtro por:</label>
            <select id="select_filter" name="select_filter" class="selectpicker form-control">
            	<option value="team">Equipo</option>
            	<option value="worker">Trabajador</option>
            </select>
        </div>
        <div class="col-xs-12">
            <input type="button" class="btn btn-primary" value="Filtrar" name="filter_order" id="filter_order">
        </div>
    </div> <!-- ./row -->
    <div class="row">
        <div class="col-xs-12">
            <table id="ordersFilter" class="table table-bordered table-condensed">
            </table>
        </div>
    </div> <!-- ./row -->
<script type="text/javascript">
    var isTeam = 1;
    $(document).ready(function(){
    	$('#datepickerstart').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
        $('#datepickerend').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });

        $("#select_filter").on("change", function(){
            isTeam = getIsTeam();
        });

        $("#filter_order").on("click", function(){
            var stadistic = {
                "startDate" : $("#order_date_start").val(),
                "endDate": $("#order_date_end").val(),
                "isTeam": isTeam
            };
            console.log(stadistic);
            $.ajax({
                type: "post",
                url: "http://testservice.xyz/v1/orders/stadistics",
                data: {"startDate": "2016/05/23 00:00:00", "endDate": "2016/05/23 00:00:00", "isTeam": "1"},
                async: true,
                crossDomain: true,
                success: function (result) {
                  console.log(result.data);  
                },
                error: function (err) {
                    console.log("Error: ", err);
                },
                beforeSend: function () {
                    console.log("Cargando ...");
                }
            });
        });
    });

    function getIsTeam(){
        var isTeam = 0;
        if($("#select_filter").val() == "team"){
            isTeam = 1;
        }
        return isTeam;
    }
</script>