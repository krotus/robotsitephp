<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/datetimepicker-custom.css">
<section class="content-header">
    <h1 class="titol_margin">
        Editar orden
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <form id="order_edit" role="form" action="" method="POST">
                <div class="form-group col-md-6 col-xs-12">
                    <label for="order_code">Codigo:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="order_code" id="order_code" value="<?php echo $data['order']->getCode(); ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="order_description">Descripción:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="order_description" id="order_description" value="<?php echo $data['order']->getDescription(); ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="process_description">Fecha de ejecución:</label>
                    <div class='input-group date' id='datepickertask'>
                        <div class="magic-span">
                            <input type='text' class="form-control" id="order_date" name="order_date" value="<?php echo $data['order']->getDate() ?>"/>
                        </div>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="order_quantity">Cantidad:</label>
                    <div class="magic-span">
                        <input type="number" class="form-control" name="order_quantity" id="order_quantity" value="<?php echo $data['order']->getQuantity(); ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label>Estado:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("order_status", "description", $data['statusOrders'], $data['order']->getStatusOrder()->getId());
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label>Robot:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("order_robot", "name", $data['robots'], $data['order']->getRobot()->getId());
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="order_priority">Prioridad:</label><br>
                    <input id="order_priority" name="order_priority" style="width:100%"
                           type="number"
                           data-provide="slider"
                           data-slider-ticks="[1, 2, 3, 4, 5, 6, 7, 8, 9, 10]"
                           data-slider-ticks-labels='["poca", "", "", "","media","","","","","alta"]'
                           data-slider-min="1"
                           data-slider-max="10"
                           data-slider-step="1"
                           data-slider-value="<?php echo $data['order']->getPriority() ?>"
                           data-slider-tooltip="show" />
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label>Proceso:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("order_process", "description", $data['processes'], $data['order']->getProcess()->getId());
                        ?>
                    </div>
                </div>
                <div class="col-xs-12 margin-bottom">
                    <input type="submit" class="btn btn-primary" value="Editar" name="process_edit">
                    <a href=".." class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        codes = <?php echo json_encode($data['codeOrders']); ?>;
    </script>
    <script src="<?php echo URL; ?>public/js/validation/order/edit.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepickertask').datetimepicker({
                format: 'YYYY/MM/DD HH:mm:ss'
            });
        });
    </script>
    <?php
    if (isset($data)) {
        if (array_key_exists("error", $data)) {
            echo '<div class="alert alert-danger" role="alert"><ul>';
            foreach ($data["error"] as $key => $error) {
                echo "<li>" . $error . "</li>";
            }
            echo '</ul></div>';
        }
    }
    ?>