<section class="content-header">
    <h1>
        Robots
        <small>Lista de los robots a detalle</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <a href="<?php echo URL."admin/robot/create" ?>" class="btn btn-primary" style="margin-bottom:10px">Añadir Robot</a>
    <!-- Modal Robot Cam view-->
    <div id="robotCamModal" class="modal fade" role="dialog">
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
    <div class="box">
      	<div class="box-body">
            <table id="robotsList" class="table table-bordered table-condensed">
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
<script type="text/javascript">
    $(document).ready(function(){
        robotListShow('<?php echo URL; ?>');
    });
</script>