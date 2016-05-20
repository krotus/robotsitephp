
<div class="row">
    <div class="col-xs-12">
	<h2>Tareas</h2>
         <a href="<?php echo URL."admin/task/create" ?>"><button id="create-button" class="btn btn-primary">Añadir Tarea</button></a>
        <table id="tasksList" class="table table-bordered table-condensed">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        taskListShow('<?php echo URL; ?>');
    });
</script>