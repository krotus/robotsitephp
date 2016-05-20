
<div class="row">
    <div class="col-xs-12">
		<h2>Robots</h2>
        <a href="<?php echo URL."admin/robot/create" ?>"><button id="create-button" class="btn btn-primary">Añadir Robot</button></a>
        <table id="robotsList" class="table table-bordered table-condensed">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        robotListShow('<?php echo URL; ?>');
    });
</script>