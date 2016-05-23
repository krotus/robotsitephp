<section class="content-header">
    <h1>
        Editar proceso
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <form id="process_edit" role="form" action="" method="POST">
                <div class="form-group col-md-6 col-xs-12">
                    <label for="process_code">Codigo:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="process_code" 
                           id="process_code" value="<?php echo $data['process']->getCode()?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="process_description">Descripción:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="process_description" 
                           id="process_description" value="<?php echo $data['process']->getDescription()?>">
                    </div>
                </div>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary" value="Editar" name="process_edit">
                    <a href=".." class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
<script src="<?php echo URL; ?>public/js/validation/process/create.js"></script>
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