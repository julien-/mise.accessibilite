<script type="text/javascript" src="../../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-stats"></i>&nbsp;&nbsp;Progression sur tout le cours
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<script type="text/javascript">
            var optionsBarChart =   {
                                title:"",
                                enableInteractivity: false,
                                height:100, axisTitlesPosition: 'none',
                                legend: {position: 'none'},
                                chartArea: {top:0,height:"75%"},
                                vAxis: {title: "Exercices"},
                                backgroundColor: { fill:'transparent' },
                                hAxis: {title: "Avancement en %" , maxValue: 100,  minValue: 0}
                            };
            setBarChartOptions('../../chart/get_json_barchart_etudiant.php', optionsBarChart, 'barChart');
        	</script>
        	<div id="barChart"></div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-stats"></i>&nbsp;&nbsp;Progression par thèmes
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<?php include('graphiques_avancement_theme.php'); ?>
		</div>
	</div>
</div>