function teamListShow(baseUrl) {

    $.ajax({
        type: "GET",
        url: baseUrl + "admin/team/getTeamsByAjax",
        success: function (data) {
            var dades = JSON.parse(data);
            $('#teamsList').html('');
            $('#teamsList').DataTable({
                data: dades,
                columns: [
                    {title: "Código"},
                    {title: "Nombre"},
                    {title: "Trabajadores"},
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
            $('#teamsList').html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        }
    });

}

function deleteTeam(teamId, baseUrl){
    swal({
        title: "¿Seguro que quieres eliminar el equipo?",
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
        url: baseUrl+"admin/team/delete/"+teamId,
        success: function (data) {
            swal("Equipo eliminado", "El Equipo ha sido eliminado correctamente", "success");
            $('#teamsList').DataTable().destroy();
                teamListShow(baseUrl);
        },
        error: function (err) {
            console.log(err);
        },
        beforeSend: function () {
        }
    });
      
    });
}