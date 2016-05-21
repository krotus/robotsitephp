$(document).ready(function(){
	$('#camModal').on('shown.bs.modal', function () {
        startRender();
    });
    $('#camModal').on('hidden.bs.modal', function () {
    	stopRender();
	});
});

function toogleCam(){
	$('#camModal').modal('toggle');
}