<section class="content-header">
    <h1 class="titol_margin">
        Editar equipo
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <form id="team_edit" role="form" action="" method="POST">
                <div class="form-group col-md-6 col-xs-12">
                    <label for="team_code">Codigo:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="team_code" id="team_code" value="<?php echo $data['team']->getCode() ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="team_name">Nombre:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="team_name" id="team_name" value="<?php echo $data['team']->getName() ?>">
                    </div>
                </div>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary" value="Editar" name="team_edit">
                    <a href=".." class="btn btn-danger boto_margin">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        codes = <?php echo json_encode($data['codeTeams']); ?>;
    </script>
    <script src="<?php echo URL; ?>public/js/validation/team/edit.js"></script>
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