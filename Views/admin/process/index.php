
<div class="row">
    <div class="col-xs-12">
		<h2>Procesos</h2>
                <a href="<?php echo URL."admin/process/create" ?>"><button id="create-button" class="btn btn-primary">Añadir Proceso</button></a>
        <table id="processesList" class="table table-bordered table-condensed">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        processListShow('<?php echo URL; ?>');
    });
</script>