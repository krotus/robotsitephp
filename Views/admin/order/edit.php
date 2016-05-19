<h2>Editar orden</h2>
<div class="row">
    <div class="col-xs-12">
        <form role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="order_code">Codigo:</label>
                <input type="text" class="form-control" name="order_code" id="order_code" value="<?php echo $data['order']->getCode(); ?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="order_description">Descripción:</label>
                <input type="text" class="form-control" name="order_description" id="order_description" value="<?php echo $data['order']->getDescription(); ?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="order_quantity">Cantidad:</label>
                <input type="number" class="form-control" name="order_quantity" id="order_quantity" value="<?php echo $data['order']->getQuantity(); ?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Estado:</label>
                <?php
                App\Utility\QuickForm::createSelect("order_status", "description", $data['statusOrders'], $data['order']->getStatusOrder()->getId());
                ?>
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Robot:</label>
                <?php
                App\Utility\QuickForm::createSelect("order_robot", "name", $data['robots'], $data['order']->getRobot()->getId());
                ?>
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Proceso:</label>
                <?php
                App\Utility\QuickForm::createSelect("order_process", "description", $data['processes'], $data['order']->getProcess()->getId());
                ?>
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
                    data-slider-value="<?php echo $data['order']->getPriority()?>"
                    data-slider-tooltip="show" />
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Editar" name="process_edit">
            </div>
        </form>
    </div>
</div>
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