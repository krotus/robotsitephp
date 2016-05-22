function processListShow(baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "admin/process/getProcessesByAjax",
        success: function (data) {
            //console.log(data);
            var dades = JSON.parse(data);
            $('#processesList').html('');
            $('#processesList').DataTable({
                data: dades,
                columns: [
                    {title: "Código"},
                    {title: "Descripción"},
                    {title: "Movimientos"},
                    {title: "Opciones"}
                ],
                "language": {
                    "url": "../public/datatables/json/es.json"
                },
                "aLengthMenu": [[15, 25, 50, 75, -1], [15, 25, 50, 75, "Todos"]]

            });
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
            $('#processesList').html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        }
    });

}

function deleteProcess(processId, baseUrl){
    swal({
        title: "¿Seguro que quieres eliminar el proceso?",
        text: "Si lo eliminas no podrá ser recuperado",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Eliminar",
        closeOnConfirm: false 
    }, 
    function(){
        
        $.ajax({
        type: "GET",
        url: baseUrl+"admin/process/delete/"+processId,
        success: function (data) {
            swal("Proceso eliminado", "El Proceso ha sido eliminado correctamente", "success");
            $('#processesList').DataTable().destroy();
                processListShow(baseUrl);
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
        }
    });
      
    });
}