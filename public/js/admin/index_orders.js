function orderListShow(baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "admin/order/getOrdersByAjax",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#ordersList').html('');
            $('#ordersList').DataTable({
                data: dades,
                columns: [
                    {title: "Código"},
                    {title: "Descripción"},
                    {title: "Prioridad"},
                    {title: "Fecha programada"},
                    {title: "Proceso"},
                    {title: "Ejecuciones"},
                    {title: "Robot"},
                    {title: "Código de robot"},
                    {title: "Estado"},
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
            $('#ordersList').html('cargando');
        }
    });

}

function deleteOrder(orderId, baseUrl){
    swal({
        title: "¿Seguro que quieres eliminar la orden?",
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
        url: baseUrl+"admin/order/delete/"+orderId,
        success: function (data) {
            swal("Orden eliminada", "La orden ha sido eliminada correctamente", "success");
            $('#ordersList').DataTable().destroy();
                orderListShow(baseUrl);
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
        }
    });
      
    });
}