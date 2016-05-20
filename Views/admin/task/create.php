<h2>Añadir tarea</h2>
<div class="row">
    <div class="col-xs-12">
        <form role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
            <label>Equipo:</label>
                <?php
                App\Utility\QuickForm::createSelect("task_team", "name", $data['teams']);
                ?>
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Orden:</label>
                <?php
                App\Utility\QuickForm::createSelect("task_order", "description", $data['orders']);
                ?>
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Crear" name="task_create">
                <a href="../task" class="btn btn-danger">Cancelar</a>
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