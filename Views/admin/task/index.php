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