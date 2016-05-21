<section class="content-header">
    <h1>
        Equipos
        <small>Lista de los equipos a detalle</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
	<a href="<?php echo URL."admin/team/create" ?>" class="btn btn-primary" style="margin-bottom:10px">Añadir Equipo</a>
	<div class="box">
	  	<div class="box-body">
	        <table id="teamsList" class="table table-bordered table-condensed">
	        </table>
	    </div><!-- /.box-body -->
	</div><!-- /.box -->
<script type="text/javascript">
    $(document).ready(function(){
        teamListShow('<?php echo URL; ?>');
    });
</script>