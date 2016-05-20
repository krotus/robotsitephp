<h2>Editar perfil</h2>
<div class="row">
    <div class="col-xs-12">
        <form id="admin_profile" role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_username">Usuario:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_username" 
                       id="worker_username" value="<?php echo $data['admin']->getUsername()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_nif">NIF:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_nif" 
                       id="worker_nif" value="<?php echo $data['admin']->getNif()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_password">Contraseña:</label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_password" 
                       id="worker_password" value="<?php echo $data['admin']->getPassword()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_re_password">Confirmar contraseña:</label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_re_password" 
                       id="worker_re_password" value="<?php echo $data['admin']->getPassword()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_name">Nombre:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_name" 
                       id="worker_name" value="<?php echo $data['admin']->getName()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_surname">Apellido:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_surname" 
                       id="worker_surname" value="<?php echo $data['admin']->getSurname()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_mobile">Mobile:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_mobile" 
                       id="worker_mobile" value="<?php echo $data['admin']->getMobile()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_telephone">Teléfono:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_telephone" 
                       id="worker_telephone" value="<?php echo $data['admin']->getTelephone()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="worker_category">Categoría:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_category" 
                       id="worker_category" value="<?php echo $data['admin']->getCategory()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
            <label>Equipo:</label>
                <div class="magic-span">
                    <?php
                    App\Utility\QuickForm::createSelect("worker_team", "name", $data['teams'], $data['admin']->getTeam()->getId());
                    ?>
                </div>
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Guardar canvios" name="admin_profile" disabled>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo URL; ?>public/js/validation/profile/admin.js"></script>
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