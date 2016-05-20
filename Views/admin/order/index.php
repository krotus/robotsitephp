
<div class="row">
    <div class="col-xs-12">
		<h2>Ordenes</h2>
                <a href="<?php echo URL."admin/order/create" ?>"><button id="create-button" class="btn btn-primary">Añadir Orden</button></a>
        <table id="ordersList" class="table table-bordered table-condensed">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        orderListShow('<?php echo URL; ?>');
    });
</script>