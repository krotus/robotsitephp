<h2>Editar trabajador</h2>
<div class="row">
    <div class="col-xs-12">
        <form role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_username">Usuario:</label>
                <input type="text" class="form-control" name="worker_username" 
                       id="worker_username" value="<?php echo $data['worker']->getUsername()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_nif">NIF:</label>
                <input type="text" class="form-control" name="worker_nif" 
                       id="worker_nif" value="<?php echo $data['worker']->getNif()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_password">Contraseña:</label>
                <input type="password" class="form-control" name="worker_password" 
                       id="worker_password" value="<?php echo $data['worker']->getPassword()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_re_password">Confirmar contraseña:</label>
                <input type="password" class="form-control" name="worker_re_password" 
                       id="worker_re_password" value="<?php echo $data['worker']->getPassword()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_name">Nombre:</label>
                <input type="text" class="form-control" name="worker_name" 
                       id="worker_name" value="<?php echo $data['worker']->getName()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_surname">Apellido:</label>
                <input type="text" class="form-control" name="worker_surname" 
                       id="worker_surname" value="<?php echo $data['worker']->getSurname()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_mobile">Mobile:</label>
                <input type="text" class="form-control" name="worker_mobile" 
                       id="worker_mobile" value="<?php echo $data['worker']->getMobile()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_telephone">Teléfono:</label>
                <input type="text" class="form-control" name="worker_telephone" 
                       id="worker_telephone" value="<?php echo $data['worker']->getTelephone()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_category">Categoría:</label>
                <input type="text" class="form-control" name="worker_category" 
                       id="worker_category" value="<?php echo $data['worker']->getCategory()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Equipo:</label>
                <?php
                App\Utility\QuickForm::createSelect("worker_team", "name", $data['teams'], $data['worker']->getTeam()->getId());
                ?>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_is_admin">Admin:</label>
                <label class="radio-inline"><input type="radio" name="worker_is_admin"
                    <?php echo ($data['worker']->getIsAdmin() == 1) ? 'checked' : ''; ?>>Sí</label>
                <label class="radio-inline"><input type="radio" name="worker_is_admin" 
                    <?php echo ($data['worker']->getIsAdmin() == 0) ? 'checked' : ''; ?>>No</label>
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Editar" name="worker_edit">
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