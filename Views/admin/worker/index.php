<h2>Trabajadores</h2>

<div class="row">
    <div class="col-xs-12">
        <button class="btn btn-primary" onclick="window.location.replace('<?php echo URL."admin/worker/create" ?>')">Añadir Trabajador</button>
        <table id="workersList" class="table table-bordered table-condensed">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        workerListShow();
    });
</script>