
function robotListShow(baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "admin/robot/getRobotsByAjax",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#robotsList').html('');
            $('#robotsList').DataTable({
                data: dades,
                columns: [
                    {title: "Código"},
                    {title: "Nombre"},
                    {title: "Ubicación"},
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
            $('#robotsList').html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        }
    });

}

function deleteRobot(robotId, baseUrl){
     swal({
        title: "¿Seguro que quieres eliminar el robot?",
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
        url: baseUrl+"admin/robot/delete/"+robotId,
        success: function (data) {
            swal("Robot eliminado", "El robot ha sido eliminado correctamente", "success");
            $('#robotsList').DataTable().destroy();
                robotListShow(baseUrl);
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
        }
    });
      
    });
}