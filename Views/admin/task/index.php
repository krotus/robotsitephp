<section class="content-header">
    <h1>
        Tareas
        <small>Lista de las tareas a detalle</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
	<a href="<?php echo URL."admin/task/create" ?>" class="btn btn-primary" style="margin-bottom:10px">Añadir Tarea</a>
	<div class="box">
	  	<div class="box-body">
	        <table id="tasksList" class="table table-bordered table-condensed">
	        </table>
	    </div><!-- /.box-body -->
	</div><!-- /.box -->
<script type="text/javascript">
    $(document).ready(function(){
        taskListShow('<?php echo URL; ?>');
    });
</script>