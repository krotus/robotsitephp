<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/map.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script src="<?php echo URL; ?>public/js/admin/geolocation.js"></script>
<!-- Modal Map-->
<div id="mapModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mapa</h4>
            </div>
            <div id = 'mapdiv'></div> 
            <div class="modal-footer">
                <button type="button" id="save_ubication" class="btn btn-success pull-left">Grabar </button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div> 
<section class="content-header">
    <h2>Añadir Robot</h2>
</section>
<div class="row">
    <div class="col-xs-12">
        <form  id="robot_create" role="form" action="" method="POST">
            <div class="form-group col-md-6 col-xs-12">
                <label for="robot_code">Codigo:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="robot_code" id="robot_code">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="robot_name">Nombre:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="robot_name" id="robot_name">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="robot_ip_cam">IP Cam:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="robot_ip_cam" id="robot_ip_cam">
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label>Estado:</label>
                <div class="magic-span">
                    <?php
                    App\Utility\QuickForm::createSelect("robot_state", "description", $data['status']);
                    ?>
                </div>
            </div>
            <div class="form-group col-md-3 col-xs-12">
                <!--<div class="row">-->
                <label for="robot_latitude">Latitud:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="robot_latitude" id="robot_latitude">
                </div>
            </div>
            <div class="form-group col-md-3 col-xs-12">
                <label for="robot_longitude">Longitud:</label>
                <div class="magic-span">
                    <input type="text" class="form-control" name="robot_longitude" id="robot_longitude">
                </div>
                <!--</div>-->
            </div>
            <div class="form-group col-md-6 hidden-xs" style="height: 0.7em;">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <!--<div class="row">-->
                <button type="button" class="btn btn-info" onclick="toggleMap()" />
                <i class="glyphicon glyphicon-map-marker"></i> Abrir Mapa</button>
            </div>
            <div class="col-xs-12">
                <input type="submit" class="btn btn-primary" value="Crear" name="team_create">
                <a href="../robot" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo URL; ?>public/js/validation/robot/create.js"></script>

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