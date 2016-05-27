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
    <div class="col-xs-12 margin-bottom">
        <input type="button" class="btn btn-primary pull-left" value="Filtrar" name="filter_order" id="filter_order">
        <form id="form-pdf" method="post" action="<?php echo URL ?>admin/stadistic/getPdfbyAjax" class="pull-right">
            <input type="submit" class="btn btn-success pull-right" id="pdf_order" value="Generar PDF">
        </form>
    </div>
</div> <!-- ./row -->
<div class="row">
    <div class="col-xs-12">
        <!-- BAR CHART -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Bar Chart</h3>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div> <!-- ./row -->
<script type="text/javascript">
    var isTeam = 1;
    var stadistics = [];
    $(document).ready(function(){
        setCurrentDates();
        
    	$('#datepickerstart').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });
        $('#datepickerend').datetimepicker({
            format: 'YYYY/MM/DD HH:mm:ss'
        });

        $("#select_filter").on("change", function(){
            isTeam = getIsTeam();
        });

        getFilter('<?php echo WEBSERVICE; ?>');

        $("#filter_order").on("click", function(){
           getFilter('<?php echo WEBSERVICE; ?>');
        });

        $("#form-pdf").on("submit", function(e){
            var str = "";
            for(var i = 0 ; i < stadistics.length;i++){
                str += '<input type="text" name="headers[]" value="'+stadistics[i]['y']+'"/>';
                str += '<input type="text" name="counts[]" value="'+stadistics[i]['a']+'"/>';
            }
            $(this).html(str);
        
        });

    });
</script>