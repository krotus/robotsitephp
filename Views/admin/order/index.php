<a href="<?php echo URL."admin/order/create" ?>" class="btn btn-primary" style="margin-bottom:10px">Añadir Orden</a>
<div class="box">
  	<div class="box-body">
        <table id="ordersList" class="table table-bordered table-condensed">
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script type="text/javascript">
    $(document).ready(function(){
        orderListShow('<?php echo URL; ?>');
    });
</script>