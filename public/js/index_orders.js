
function pendingOrders(idWorker, baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "worker/getOrdersByAjax/" + idWorker + "/pending",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#pending-ord').html('');
            $('#pending-ord').DataTable({
                data: dades,
                columns: [
                    {title: "Id Orden"},
                    {title: "Código de orden"},
                    {title: "Descripción de orden"},
                    {title: "Prioridad"},
                    {title: "Fecha"},
                    {title: "Ejecuciones necesarias"},
                    {title: "Código robot"},
                    {title: "Nombre robot"},
                    {title: "Estado del robot"},
                    {title: "Opciones"}
                ],
                "language": {
                    "url": "public/datatables/json/" + lang + ".json"
                },
                "aLengthMenu": [[5, 10, 25, 50, 75, -1], [5, 10, 25, 50, 75, "Todos"]]

            });
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
            $('#pending-ord').html('cargando');
        }
    });

}
function initOrders(idWorker, baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "worker/getOrdersByAjax/" + idWorker + "/initiated",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#init-ord').html('');

            $('#init-ord').DataTable({
                data: dades,
                columns: [
                    {title: "Id Orden"},
                    {title: "Código de orden"},
                    {title: "Descripción de orden"},
                    {title: "Prioridad"},
                    {title: "Fecha"},
                    {title: "Ejecuciones necesarias"},
                    {title: "Código robot"},
                    {title: "Nombre robot"},
                    {title: "Estado del robot"},
                    {title: "Opciones"}
                ],
                "language": {
                    "url": "public/datatables/json/" + lang + ".json"
                },
                "aLengthMenu": [[5, 10, 25, 50, 75, -1], [5, 10, 25, 50, 75, "Todos"]]

            });
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
            $('#init-ord').html('cargando');
        }
    });
}
function completedOrders(idWorker, baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "worker/getOrdersByAjax/" + idWorker + "/completed",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#completed-ord').html('');

            $('#completed-ord').DataTable({
                data: dades,
                columns: [
                    {title: "Id Orden"},
                    {title: "Código de orden"},
                    {title: "Descripción de orden"},
                    {title: "Prioridad"},
                    {title: "Fecha"},
                    {title: "Ejecuciones necesarias"},
                    {title: "Código robot"},
                    {title: "Nombre robot"},
                    {title: "Estado del robot"},
                ],
                "language": {
                    "url": "public/datatables/json/" + lang + ".json"
                },
                "aLengthMenu": [[5, 10, 25, 50, 75, -1], [5, 10, 25, 50, 75, "Todos"]]

            });
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
            $('#completed-ord').html('cargando');
        }
    });
}
function uncompletedOrders(idWorker, baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "worker/getOrdersByAjax/" + idWorker + "/uncompleted",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#uncompleted-ord').html('');

            $('#uncompleted-ord').DataTable({
                data: dades,
                columns: [
                    {title: "Id Orden"},
                    {title: "Código de orden"},
                    {title: "Descripción de orden"},
                    {title: "Prioridad"},
                    {title: "Fecha"},
                    {title: "Ejecuciones necesarias"},
                    {title: "Código robot"},
                    {title: "Nombre robot"},
                    {title: "Estado del robot"},
                ],
                "language": {
                    "url": "public/datatables/json/" + lang + ".json"
                },
                "aLengthMenu": [[5, 10, 25, 50, 75, -1], [5, 10, 25, 50, 75, "Todos"]]

            });
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
            $('#uncompleted-ord').html('cargando');
        }
    });
}
function cancelledOrders(idWorker, baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "worker/getOrdersByAjax/" + idWorker + "/cancelled",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#cancelled-ord').html('');

            $('#cancelled-ord').DataTable({
                data: dades,
                columns: [
                    {title: "Id Orden"},
                    {title: "Código de orden"},
                    {title: "Descripción de orden"},
                    {title: "Prioridad"},
                    {title: "Fecha"},
                    {title: "Ejecuciones necesarias"},
                    {title: "Código robot"},
                    {title: "Nombre robot"},
                    {title: "Estado del robot"},
                    {title: "Opciones"}
                ],
                "language": {
                    "url": "public/datatables/json/" + lang + ".json"
                },
                "aLengthMenu": [[5, 10, 25, 50, 75, -1], [5, 10, 25, 50, 75, "Todos"]]

            });
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
            $('#cancelled-ord').html('cargando');
        }
    });
}

function setCompletedTime(idOrder) {
    $('#completedModal').modal('toggle');
}

function specifyIssue(idOrder) {
    $('#cancelledModal').modal('toggle');
}

function executeOrder(idOrd, status, idWork, baseUrl) {
    $.ajax({
        type: "get",
        url: "http://testservice.xyz/v1/orders/updateExecute/" + idOrd + "/" + status + "/" + idWork,
        crossDomain: true,
        success: function (data) {
            $('#confirmModal>div>div').attr('class', 'alert alert-success');
            $('#confirmModal>div>div').html(data.message);
            $('#pending-ord').DataTable().destroy();
            pendingOrders(idWork, baseUrl);
            $('#init-ord').DataTable().destroy();
            initOrders(idWork, baseUrl);
            setTimeout(function () {
                $('#confirmModal').modal('toggle');
            }, 3500);
        },
        error: function (err) {
            $('#confirmModal>div>div').attr('class', 'alert alert-danger');
            $('#confirmModal>div>div').html(err.message);
            console.log(err);
            setTimeout(function () {
                $('#confirmModal').modal('toggle');
            }, 3500);
        },
        beforeSend: function () {
            $('#confirmModal>div>div').html('cargando...');
            $('#confirmModal').modal('toggle');
        }
    });
}