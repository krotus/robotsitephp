function workerListShow(baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "admin/worker/getWorkersByAjax",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#workersList').html('');
            $('#workersList').DataTable({
                data: dades,
                columns: [
                    {title: "Usuario"},
                    {title: "NIF"},
                    {title: "Nombre"},
                    {title: "Apellido"},
                    {title: "Móvil"},
                    {title: "Teléfono"},
                    {title: "Categoría"},
                    {title: "Administrador"},
                    {title: "Equipo"},
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
            $('#workersList').html('cargando');
        }
    });

}

function deleteWorker(workerId, baseUrl){
    swal({
        title: "¿Seguro que quieres eliminar el trabajador?",
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
        url: baseUrl+"admin/worker/delete/"+workerId,
        success: function (data) {
            swal("Trabajador eliminado", "El trabajador ha sido eliminado correctamente", "success");
            $('#workersList').DataTable().destroy();
                workerListShow(baseUrl);
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
        }
    });
      
    });
}
