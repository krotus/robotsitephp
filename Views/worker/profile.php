<div class="row">
    <div class="col-xs-12">
        <div class="col-md-12">
            <h2>Modificar perfil</h2>
        </div>
        <form id="worker_profile" role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_username"><?php echo $trans['profile_worker_username'] ?></label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_username" id="worker_username" value="<?php echo $data['worker']->getUsername()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_nif"><?php echo $trans['profile_worker_nif'] ?></label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_nif" id="worker_nif" value="<?php echo $data['worker']->getNif()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_password"><?php echo $trans['profile_worker_password'] ?></label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_password" id="worker_password" value="<?php echo $data['worker']->getPassword()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_re_password"><?php echo $trans['profile_worker_re_password'] ?></label>
                <div class="magic-span">
                    <input type="password" class="form-control" name="worker_re_password" id="worker_re_password" value="<?php echo $data['worker']->getPassword()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_name"><?php echo $trans['profile_worker_name'] ?></label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_name" id="worker_name" value="<?php echo $data['worker']->getName()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_surname"><?php echo $trans['profile_worker_surname'] ?></label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_surname" id="worker_surname" value="<?php echo $data['worker']->getSurname()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_mobile"><?php echo $trans['profile_worker_mobile'] ?></label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_mobile" id="worker_mobile" value="<?php echo $data['worker']->getMobile()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_telephone"><?php echo $trans['profile_worker_telephone'] ?></label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_telephone" id="worker_telephone" value="<?php echo $data['worker']->getTelephone()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_category"><?php echo $trans['profile_worker_category'] ?></label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="worker_category" id="worker_category" value="<?php echo $data['worker']->getCategory()?>">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label><?php echo $trans['profile_worker_team'] ?></label>
                <label class="form-control"><?php echo $data['worker']->getTeam()->getName(); ?></label>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label class="control-label" for="worker_language"><?php echo $trans['profile_worker_language'] ?></label>
                <div class="magic-span">
                    <?php
                    App\Utility\QuickForm::createSelect("worker_language", "description", $data['languages'], $data['worker']->getLanguage()->getId());
                    ?>
                </div>
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Guardar canvios" name="worker_profile" disabled>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo URL; ?>public/js/validation/profile/worker.js"></script>
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