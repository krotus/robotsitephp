function setCurrentDates(){
    var today = new Date();
    var year = today.getFullYear().toString();
    var month = today.getMonth()+1;
    var monthS = (today.getMonth()).toString();
    var day = today.getDate();
    var nextYear = today.getFullYear();
    var nextMonth = today.getMonth();
    if (month == 12) {
        nextYear = (nextYear+1).toString();
        nextMonth = "01";
    }else{
        nextYear = nextYear.toString();
        nextMonth = (nextMonth+2).toString();
    }
    $('#order_date_start').val(year+"/"+monthS+"/"+day+" 00:00:00");
    $('#order_date_end').val(nextYear+"/"+nextMonth+"/"+day+" 00:00:00");
}

function filterAction(baseUrl){
    
    $('#ordersFilter').DataTable().destroy();
    loadTable(baseUrl);
}

function loadTable(baseUrl){
    var strDate = $('#order_date_start').val();
    var endDate = $('#order_date_end').val();
    var idStatus = $('#order_status').val();
    var idTeam = "0";
    var idWorker = "0";
    if ($('#select-filter-type').val() == "team") {
        idTeam = $('#select_filter').val();
    }else if($('#select-filter-type').val() == "worker"){
        idWorker = $('#select_filter').val();
    }
    
     $.ajax({
        type: "POST",
        url: baseUrl + "admin/stadistic/getStadisticOrdersByAjax",
        data:{"str_date": strDate, "end_date": endDate, "id_team": idTeam,"id_worker": idWorker, "id_status": idStatus},
        success: function (data) {
          var dades = JSON.parse(data);
            $('#ordersFilter').html('');
            $('#ordersFilter').DataTable({
                data: dades,
                columns: [
                    {title: "Trabajador"},
                    {title: "Equipo"},
                    {title: "Código de orden"},
                    {title: "Orden"},
                    {title: "Prioridad"},
                    {title: "Fecha de ejecución"},
                    {title: "Proceso"},
                    {title: "Ejecuciones"},
                    {title: "Robot"},
                    {title: "Código de robot"},
                    {title: "Estado de la orden"}
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
            $('#ordersFilter').html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        }
    });

}

function switchFilter(valueFilter, baseUrl){
    	switch(valueFilter){
    		case "worker":
               $.getJSON( baseUrl+"admin/stadistic/getWorkersAjax", function( workers ) {
                    var select = "";
                    for(var i = 0; i < workers.length; i++){
                        select += "<option value="+workers[i].id+">"+workers[i].username+"</option>";
                    }
                    $("#select_filter").html(select); 
                });
                break;
            case "team":

                $.getJSON( baseUrl+"admin/stadistic/getTeamsAjax", function( teams ) {
                    var select = "";
                    for(var i = 0; i < teams.length; i++){
                        select += "<option value="+teams[i].id+">"+teams[i].name+"</option>";
                    }
                    $("#select_filter").html(select);     
                    $("#select_filter").show();     
                });
                break;
            default:
                $("#select_filter").html("<option value='0'> - - - - - - - - - - - - - - </option>");  
    			break;
    	}
    }