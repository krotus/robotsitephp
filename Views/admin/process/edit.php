<h2>Editar proceso</h2>
<div class="row">
    <div class="col-xs-12">
        <form role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="process_code">Codigo:</label>
                <input type="text" class="form-control" name="process_code" 
                       id="process_code" value="<?php echo $data['process']->getCode()?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="process_description">Descripción:</label>
                <input type="text" class="form-control" name="process_description" 
                       id="process_description" value="<?php echo $data['process']->getDescription()?>">
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