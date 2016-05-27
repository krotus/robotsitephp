function showRobotsByStatus(baseUrl){
		$.ajax({
		    type: "GET",
		    url: baseUrl+"orders/stadisticsRobots",
		    async: true,
		    crossDomain: true,
		    success: function (result) {
	            var array = [];
	            for(var i = 0; i < result.data.length; i++){
	                var arrayN = [];
	                var name = result.data[i].robots_dsc;
	                var count = result.data[i].robots_qnt;
	                arrayN['label'] = name;
	                arrayN['value'] = count;
	                array.push(arrayN);
	            }
	            //DONUT CHART
				var donut = new Morris.Donut({
					element: 'robots-chart',
					resize: true,
					colors: ["#00a65a", "#cecece", "#f39c12", "#f56954"],
					data: array,
					hideHover: 'auto'
				});
		    },
		    error: function (err) {
		        console.log("Error: ", err);
		    },
		    beforeSend: function () {
		        //console.log("Cargando ...");
		    }
		});
}