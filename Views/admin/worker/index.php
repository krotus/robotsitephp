<h2>Trabajadores</h2>

<div class="row">
    <div class="col-xs-12">
        <a href="<?php echo URL."admin/worker/create" ?>"><button class="btn btn-primary">Añadir Trabajador</button></a>
        <table id="workersList" class="table table-bordered table-condensed">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        workerListShow();
    });
</script>