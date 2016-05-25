<section class="content-header">
    <h1 class="titol_margin">
        Añadir tarea
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <form id="task_create" role="form" action="" method="POST">
                <div class="form-group col-md-6 col-xs-12">
                    <label>Equipo:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("task_team", "name", $data['teams']);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label>Orden:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("task_order", "description", $data['orders']);
                        ?>
                    </div>
                </div>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary" value="Crear" name="task_create">
                    <a href="../task" class="btn btn-danger boto_margin">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo URL; ?>public/js/validation/task/create.js"></script>

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