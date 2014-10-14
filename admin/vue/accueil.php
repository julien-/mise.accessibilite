<script type="text/javascript"
	src="../../js/googleChartToolsLineChart.js"></script>
<div class="row">
	<div class="col-lg-12 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-stats"></i> Visites sur les 7
					derniers jours
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">
        var optionsBarChart = {
        		chartArea: {left:0,top:50,height:"75%", width: "100%"},
        		backgroundColor: { fill:'transparent' },
        		legend: {position: 'none'},
        };
        setBarChartOptions('../../chart/get_json_visits.php', optionsBarChart, 'lineChart');
    </script>
					<div id=lineChart style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-comment"></i> Derniers messages sur
					le forum
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-bar-chart-o fa-fw"></i> Derniers messages sur le
					forum
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart"></div>
			</div>
		</div>
	</div>
</div>