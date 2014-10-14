<script type="text/javascript"
  src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'>
</script>
<script type="text/javascript" src="../../js/googleChartToolsBarChart.js"></script>

<script type="text/javascript">
var optionsBarChart =   {
	enableInteractivity: true,
	width:"100%", height:100, axisTitlesPosition: 'none',
	chartArea: {left:"10%",top:0,right:"10%",height:"75%"},
	backgroundColor: { fill:'transparent' },
	vAxis: {title: "Exercices"},
	legend: {position: 'none'},
	hAxis: {maxValue: 100,  minValue: 0}
};
setBarChartOptions('../../chart/get_json_barchart_global.php?', optionsBarChart, 'barChart');
</script>

<!-- Avancement global -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-align-left"></i> Avancement Global
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<div id="barChart" style="width: auto; height: auto;"></div>
		</div>
	</div>
</div>

<!-- Visualisation Pokemons -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-leaf"></i> Mes Pokémons
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">

		</div>
	</div>
</div>

<!-- Visualisation Escaliers -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-stats"></i> Mon Evolution par Thème
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">

		</div>
	</div>
</div>



