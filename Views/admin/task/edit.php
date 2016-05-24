<section class="content-header">
    <h1>
        Editar tarea
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <form id="task_edit" role="form" action="" method="POST">
                <div class="form-group col-md-6 col-xs-12">
                <label>Equipo:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("task_team", "name", $data['teams'], $data['task']->getTeam()->getId());
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                <label>Orden:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("task_order", "description", $data['orders'], $data['task']->getOrder()->getId());
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                <label>Trabajador:</label>
                    <div class="magic-span">
                        <?php
                            App\Utility\QuickForm::createSelect("task_worker", "name", $data['workersTaskTeam'], $data['task']->getWorker()->getId());
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="task_date_completion">Fecha a completada:</label>
                    <div class='input-group date' id='datepickertask'>
                        <div class="magic-span">
                            <input type='text' class="form-control" id="task_date_completion" name="task_date_completion" value="<?php echo $data['task']->getDateCompletion() ?>"/>
                        </div>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label class="control-label" for="task_justification">Justificación:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="task_justification" id="task_justification" value="<?php echo $data['task']->getJustification()?>">
                    </div>
                </div>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary" value="Editar" name="task_edit">
                    <a href=".." class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
<script src="<?php echo URL; ?>public/js/validation/task/edit.js"></script>
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