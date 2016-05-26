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
                <button type="button" class="btn btn-danger pull-right boto_margin" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div> 
<section class="content-header">
    <h1 class="titol_margin">
        Editar robot
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <form id="robot_edit" role="form" action="" method="POST">
                <div class="form-group col-md-6 col-xs-12">
                    <label for="robot_code">Codigo:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="robot_code" id="robot_code" value="<?php echo $data['robot']->getCode() ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="robot_name">Nombre:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="robot_name" id="robot_name" value="<?php echo $data['robot']->getName() ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="robot_ip_cam">IP Cam:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="robot_ip_cam" id="robot_ip_cam" value="<?php echo $data['robot']->getIpCam() ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label>Estat:</label>
                    <div class="magic-span">
                        <?php
                        App\Utility\QuickForm::createSelect("robot_state", "description", $data['status'], true);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-3 col-xs-12">
                    <label for="robot_latitude">Latitud:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="robot_latitude" id="robot_latitude" value="<?php echo $data['robot']->getLatitude() ?>">
                    </div>
                </div>
                <div class="form-group col-md-3 col-xs-12">
                    <label for="robot_longitude">Longitud:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="robot_longitude" id="robot_longitude" value="<?php echo $data['robot']->getLongitude() ?>">
                    </div>
                </div>
                <div class="form-group col-md-6 hidden-xs" style="height: 0.7em;">
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <button type="button" class="btn btn-info" onclick="toggleMap()" />
                    <i class="glyphicon glyphicon-map-marker"></i> Abrir Mapa</button>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="robot_ip_address">Ip:</label>
                    <div class="magic-span">
                        <input type="text" class="form-control" name="robot_ip_address" id="robot_ip_address" value="<?php echo $data['robot']->getIpAddress() ?>">
                    </div>
                </div>
                <div class="col-xs-12 margin-bottom">
                    <input type="submit" class="btn btn-primary" value="Editar" name="team_edit">
                    <a href=".." class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        codes = <?php echo json_encode($data['codeRobots']); ?>;
    </script>
<script src="<?php echo URL; ?>public/js/validation/robot/edit.js"></script>
<?php
if (isset($data)) {
    if (array_key_exists("error", $data)) {
        App\Utility\QuickForm::showListErrors($data["error"]);
    }
}
?>
