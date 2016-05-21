<section class="content-header">
    <h1>
        Procesos
        <small>Lista de los procesos a detalle</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
	<a href="<?php echo URL."admin/process/create" ?>" class="btn btn-primary" style="margin-bottom:10px">Añadir Proceso</a>
	<div class="box">
	  	<div class="box-body">
	        <table id="processesList" class="table table-bordered table-condensed">
	        </table>
	    </div><!-- /.box-body -->
	</div><!-- /.box -->
<script type="text/javascript">
    $(document).ready(function(){
        processListShow('<?php echo URL; ?>');
    });
</script>