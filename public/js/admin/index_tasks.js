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
                    {title: "Completada el"},
                    {title: "Cancelada por"},
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
            $('#tasksList').html('cargando');
        }
    });

}