<section class="content-header">
    <h1 class="titol_margin">
        Añadir Equipo
    </h1>
</section>
<section class="content">
<div class="row">
    <div class="col-xs-12">
        <form id="team_create" role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="team_code">Codigo:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="team_code" id="team_code">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="team_name">Nombre:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="team_name" id="team_name">
                </div>
            </div>
            <div class="col-xs-12 margin-bottom">
                <input type="submit" class="btn btn-primary" value="Crear" name="team_create">
                <a href="../team" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<script>
    codes = <?php echo json_encode($data['codeTeams']); ?>;
</script>
<script src="<?php echo URL; ?>public/js/validation/team/create.js"></script>
<?php
if (isset($data)) {
    if (array_key_exists("error", $data)) {
        App\Utility\QuickForm::showListErrors($data["error"]);
    }
}
?>