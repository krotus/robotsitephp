<div class="row">
    <div class="col-xs-12">
        <div class="col-md-12">
            <h2>Añadir trabajador</h2>   
        </div>
        <form id="worker_create" role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_username">Usuario:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_username" id="worker_username">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_nif">NIF:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_nif" id="worker_nif">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_password">Contraseña:</label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_password" id="worker_password">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_re_password">Confirmar contraseña:</label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_re_password" id="worker_re_password">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_name">Nombre:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_name" id="worker_name">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_surname">Apellido:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_surname" id="worker_surname">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_mobile">Mobile:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_mobile" id="worker_mobile">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_telephone">Teléfono:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_telephone" id="worker_telephone">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_category">Categoría:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_category" id="worker_category">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label>Equipo:</label>
                <div class="magic-span">
                    <?php
                    App\Utility\QuickForm::createSelect("worker_team", "name", $data['teams']);
                    ?>
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_is_admin">Admin:</label>
                <label class="radio-inline"><input type="radio" value="1" name="worker_is_admin">Sí</label>
                <label class="radio-inline"><input type="radio" value="0" name="worker_is_admin" checked>No</label>
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Crear" name="worker_create">
                <a href="../worker" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo URL; ?>public/js/validation/worker/create.js"></script>
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