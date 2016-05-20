<h2>Equipos</h2>

<div class="row">
    <div class="col-xs-12">
        <a href="<?php echo URL."admin/team/create" ?>"><button id="create-button" class="btn btn-primary">Añadir Equipo</button></a>
        <table id="teamsList" class="table table-bordered table-condensed">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        teamListShow('<?php echo URL; ?>');
    });
</script>