<h2>Editar tarea</h2>
<div class="row">
    <div class="col-xs-12">
        <form role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
            <label>Equipo:</label>
                <?php
                App\Utility\QuickForm::createSelect("task_team", "name", $data['teams'], $data['task']->getTeam()->getId());
                ?>
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Orden:</label>
                <?php
                App\Utility\QuickForm::createSelect("task_order", "description", $data['orders'], $data['task']->getOrder()->getId());
                ?>
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Trabajador:</label>
                <?php
                App\Utility\QuickForm::createSelect("task_worker", "name", $data['workers'], $data['task']->getWorker()->getId());
                ?>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="task_date_completion">Fecha a completada:</label>
                <div class='input-group date' id='datepickertask'>
                    <input type='text' class="form-control" id="task_date_completion" name="task_date_completion" value="<?php echo $data['task']->getDateCompletion() ?>"/>
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
            </div>
        </form>
    </div>
</div>
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