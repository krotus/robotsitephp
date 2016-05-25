<!--<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/datetimepicker-custom.css">-->
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
                    <input type='text' class="form-control" id="order_date_str" name="order_date"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <label for="order_code">Fin:</label>
                <div class='input-group date' id='datepickerend'>
                    <input type='text' class="form-control" id="order_date_end" name="order_date"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group col-md-2 col-xs-12">
            <label for="order_code">Filtro por:</label>
            <select id="select-filter-type" class="selectpicker form-control" >
                <option value="empty">Ningun</option>
                <option value="team">Equipo</option>
                <option value="worker">Trabajador</option>
            </select>
        </div>
        <div class="form-group col-md-2 col-xs-12">
            <label for="order_code">&nbsp;</label>
            <select id="select_filter" class="selectpicker form-control">
                <option value="0"> - - - - - - - - - - - - - - </option>
            </select>
        </div>
        <div class="form-group col-md-2 col-xs-12">
            <label for="order_status">Estado:</label>
            <?php
            App\Utility\QuickForm::createSelect("order_status", "description", $data['statusOrders']);
            ?>
        </div>
        <div class="col-xs-12">
            <input type="button" class="btn btn-primary" value="Filtrar" name="filter_order" onclick="loadTable('<?php echo URL; ?>')">
        </div>
    </div> <!-- ./row -->
    <div class="box">
        <div class="box-body">
            <table id="ordersFilter" class="table table-bordered table-condensed">
            </table>
        </div><!-- /.box-body -->
    </div> <!-- ./row -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('#select-filter-type').change(function () {
                switchFilter(this.value, '<?php echo URL; ?>');
            });

            $('#datepickerstart').datetimepicker({
                format: 'YYYY/MM/DD HH:mm:ss'
            });
            $('#datepickerend').datetimepicker({
                format: 'YYYY/MM/DD HH:mm:ss'
            });
            ordersListStadistics();
            $("#select_filter").show();

            //loadTable();
        });

    </script>