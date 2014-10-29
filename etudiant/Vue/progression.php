<script type="text/javascript" src="../../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-stats"></i>Progression sur tout le cours
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<script type="text/javascript">
            var optionsBarChart =   {
                                title:"",
                                enableInteractivity: false,
                                width:1000, height:100, axisTitlesPosition: 'none',
                                legend: {position: 'none'},
                                chartArea: {left:"20%",top:0,width:500,height:"75%"},
                                vAxis: {title: "Exercices"},
                                backgroundColor: { fill:'transparent' },
                                hAxis: {title: "Avancement en %" , maxValue: 100,  minValue: 0}
                            };
            setBarChartOptions('../../chart/get_json_barchart_etudiant.php', optionsBarChart, 'barChart');
        	</script>
        	<div id="barChart" style="width: auto; height: auto;"></div>
		</div>
	</div>
</div>
<?php include('graphiques_avancement_theme.php'); ?>