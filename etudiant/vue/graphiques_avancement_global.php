<script type="text/javascript" src="../../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript">
	var optionsBarChart =   {
		enableInteractivity: true,
		height:100, axisTitlesPosition: 'none',
		chartArea: {top:0,height:"75%"},
		backgroundColor: { fill:'transparent' },
		vAxis: {title: "Exercices"},
		legend: {position: 'none'},
		hAxis: {maxValue: 100,  minValue: 0}
	};
	setBarChartOptions('../../chart/get_json_barchart_global.php?', optionsBarChart, 'barChart');
</script>
<div id="barChart"></div>