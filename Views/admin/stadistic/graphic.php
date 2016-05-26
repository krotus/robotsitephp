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
    <input type="button" class="btn btn-primary" value="Filtrar" name="filter_order" id="filter_order">
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

        var today = new Date();

        var stadistic = {
            "startDate" : today.getFullYear.toString()+"-"+(today.getMonth()+1).toString()+"-"+today.getDate().toString() + " 00:00:00",
            "endDate": today.getFullYear.toString()+"-"+(today.getMonth()+1).toString()+"-"+today.getDate().toString() + " 23:59:59",
            "isTeam": isTeam
        };

        getFilter(stadistic);

        $("#filter_order").on("click", function(){
           var stadistic = {
                "startDate" : $("#order_date_start").val(),
                "endDate": $("#order_date_end").val(),
                "isTeam": isTeam
            };
            getFilter(stadistic);
        });

    });

    function getFilter(stadistic){
        $.ajax({
            type: "post",
            url: "http://testservice.xyz/v1/orders/stadistics",
            data: stadistic,
            async: true,
            crossDomain: true,
            success: function (result) {
                if(isTeam == 1){
                    var array = [];
                    for(var i = 0; i < result.data.length; i++){
                        var arrayN = [];
                        var name = result.data[i].name;
                        var count = result.data[i].tasks_done;
                        arrayN['y'] = name;
                        arrayN['a'] = count;
                        array.push(arrayN);
                    }
                    //BAR CHART
                    var bar = new Morris.Bar({
                        element: 'bar-chart',
                        resize: true,
                        data: array,
                        barColors: ['#00a65a'],
                        xkey: 'y',
                        ykeys: ['a'],
                        labels: ['Completadas'],
                        hideHover: 'auto'
                    });
                }else{
                    var array = [];
                    for(var i = 0; i < result.data.length; i++){
                        var arrayN = [];
                        var name = result.data[i].worker;
                        var count = result.data[i].tasks_done;
                        arrayN['y'] = name;
                        arrayN['a'] = count;
                        array.push(arrayN);
                    }
                    console.log(array);
                    var bar = new Morris.Bar({
                        element: 'bar-chart',
                        resize: true,
                        data: array,
                        barColors: ['#00a65a'],
                        xkey: 'y',
                        ykeys: ['a'],
                        labels: ['Completadas'],
                        hideHover: 'auto'
                    });
                }

            },
            error: function (err) {
                console.log("Error: ", err);
            },
            beforeSend: function () {
                console.log("Cargando ...");
            }
        });
    }

    function getIsTeam(){
        var isTeam = 0;
        if($("#select_filter").val() == "team"){
            isTeam = 1;
        }
        return isTeam;
    }
</script>