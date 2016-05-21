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