function taskListShow(baseUrl) {

//    $.ajax({
//        type: "GET",
//        url: baseUrl + "worker/getOrdersByAjax/" + idWorker + "/pending",
//        success: function (data) {
//            var dades = JSON.parse(data);
//            $('#pending-ord').html('');
            $('#tasksList').DataTable({
                data: dataSet,
                columns: [
                    {title: "Id Trabajador"},
                    {title: "Usuario"},
                    {title: "NIF"},
                    {title: "Nombre"},
                    {title: "Apellido"},
                    {title: "Móvil"},
                    {title: "Teléfono"},
                    {title: "Categoría"},
                    {title: "Equipo"},
                    {title: "Administrador"},
                    {title: "Opciones"}
                ],
                "language": {
                    "url": "../public/datatables/json/es.json"
                },
                "aLengthMenu": [[15, 25, 50, 75, -1], [15, 25, 50, 75, "Todos"]]

            });
//        },
//        error: function (err) {
//            console.log(err);
//        },
//        beforeSend: function () {
//            $('#pending-ord').html('cargando');
//        }
//    });

}