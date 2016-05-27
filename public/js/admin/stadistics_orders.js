
function getFilter(baseUrl) {
    var stadistic = {
        "startDate": $("#order_date_start").val(),
        "endDate": $("#order_date_end").val(),
        "isTeam": isTeam
    };
    $.ajax({
        type: "post",
        url: baseUrl+"orders/stadistics",
        data: stadistic,
        async: true,
        crossDomain: true,
        success: function (result) {
            if (isTeam == 1) {
                stadistics = [];
                for (var i = 0; i < result.data.length; i++) {
                    var arrayN = [];
                    var name = result.data[i].name;
                    var count = result.data[i].tasks_done;
                    arrayN['y'] = name;
                    arrayN['a'] = count;
                    stadistics.push(arrayN);
                }
                //BAR CHART
                $('#bar-chart').html('');
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: stadistics,
                    barColors: ['#00a65a'],
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['Completadas'],
                    hideHover: 'auto'
                });
            } else {
                stadistics = [];
                for (var i = 0; i < result.data.length; i++) {
                    var arrayN = [];
                    var name = result.data[i].worker;
                    var count = result.data[i].tasks_done;
                    arrayN['y'] = name;
                    arrayN['a'] = count;
                    stadistics.push(arrayN);
                }
                $('#bar-chart').html('');
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: stadistics,
                    barColors: ['#00a65a'],
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['Completadas'],
                    hideHover: 'auto'
                });
            }

        },
        error: function (err) {
            console.log("Error: ", err);
        },
        beforeSend: function () {
            console.log("Cargando ...");
        }
    });
}

function getIsTeam() {
    var isTeam = 0;
    if ($("#select_filter").val() == "team") {
        isTeam = 1;
    }
    return isTeam;
}