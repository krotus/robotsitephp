<a href="<?php echo URL."admin/robot/create" ?>" class="btn btn-primary" style="margin-bottom:10px">Añadir Robot</a>
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