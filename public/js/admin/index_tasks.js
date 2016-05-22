function taskListShow(baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "admin/task/getTasksByAjax",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#tasksList').html('');
            $('#tasksList').DataTable({
                data: dades,
                columns: [
                    {title: "Id Tarea"},
                    {title: "Equipo"},
                    {title: "Descripción"},
                    {title: "Ejecutada por"},
                    {title: "Fecha de asignación"},
                    {title: "Fecha completada"},
                    {title: "Justificación"},
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
            $('#tasksList').html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        }
    });

}

function deleteTask(idTask, baseUrl){
    swal({
        title: "¿Seguro que quieres eliminar la tarea?",
        text: "Si la eliminas no podrá ser recuperada",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Eliminar",
        closeOnConfirm: false 
    }, 
    function(){
        
        $.ajax({
        type: "GET",
        url: baseUrl+"admin/task/delete/"+idTask,
        success: function (data) {
            swal("Tarea eliminada", "La tarea ha sido eliminada correctamente", "success");
            $('#tasksList').DataTable().destroy();
                taskListShow(baseUrl);
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
        }
    });
      
    });
}