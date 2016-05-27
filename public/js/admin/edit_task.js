function updateData(workers) {
		var teamSelected = $("#task_team").val();
		var workersFilter = filterWorkersByTeam(teamSelected,workers);
		dropdownFill(workersFilter);
}

function getWorkers(baseUrl) {
    $.ajax({
        type: "GET",
        url: baseUrl+"workers/getAll",
        async: true,
        crossDomain: true,
        success: function (result) {
        	workers = result.data
        	updateData(workers);
        },
        error: function (err) {
            console.log("Error: ", err);
        },
        beforeSend: function () {
            console.log("Cargando ...");
        }
    });
}

function dropdownFill(arrayWorkers) {
	$('#task_worker').html(" ");
	var options = "";
	for (var i=0;i<arrayWorkers.length;i++){
	   options += "<option value='"+arrayWorkers[i].id+"'>"+arrayWorkers[i].name+"</option>";
	}
	$('#task_worker').html(options);
}

function filterWorkersByTeam(idTeam,workers) {
	var arrayWorkers = new Array();
	for (var i = 0; i < workers.length; i++) {
		if (idTeam == workers[i].id_team) {
			arrayWorkers.push(workers[i]);
		}
	}
	return arrayWorkers;
}
