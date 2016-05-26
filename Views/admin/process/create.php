<section class="content-header">
        <h1 class="titol_margin">
            Añadir proceso
        </h1>
</section>
<section class="content">
<div class="row">
    <div class="col-xs-12">
        <form id="process_create" role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="process_code">Code:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="process_code" id="process_code">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="process_description">Description:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="process_description" id="process_description">
                </div>
            </div>
            <div class="col-xs-12 margin-bottom">
                <input type="submit" class="btn btn-primary" value="Crear" name="process_create">
                <a href="../process" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<script>
    codes = <?php echo json_encode($data['codeProcesses']); ?>;
</script>
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