<a href="<?php echo URL."admin/worker/create" ?>" class="btn btn-primary" style="margin-bottom:10px">Añadir Trabajador</a>
<div class="box">
  	<div class="box-body">
        <table id="workersList" class="table table-bordered table-condensed">
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script type="text/javascript">
    $(document).ready(function(){
        workerListShow('<?php echo URL; ?>');
    });
</script>