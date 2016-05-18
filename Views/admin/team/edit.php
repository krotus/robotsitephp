<h2>Editar Equipo</h2>
<div class="row">
    <div class="col-xs-12">
        <form role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="team_code">Codigo:</label>
                <input type="text" class="form-control" name="team_code" id="team_code" value="<?php echo $data['team']->getCode() ?>">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="team_name">Nombre:</label>
                <input type="text" class="form-control" name="team_name" id="team_name" value="<?php echo $data['team']->getName() ?>">
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Crear" name="team_create">
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