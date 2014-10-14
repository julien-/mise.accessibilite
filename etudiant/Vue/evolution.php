<script type="text/javascript"
  src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'>
</script>
<script type="text/javascript" src="../../js/googleChartToolsBarChart.js"></script>
<?php 

	//echo $_SESSION["cours"]->getLibelle();
 	/*foreach ($listeSeances as $seance) {
 		
 		echo "Actuelle : " . transformerDate($seance->getDate()) . "        ";
 		
		if($mode)
			echo "Prochaine : " . transformerDate($mode->getDate());

		$mode = next($listeSeances);
		echo "<br/>";
 	}*/
		?>
		<script type="text/javascript">
		var optionsBarChart =   {
			enableInteractivity: true,
			width:1000, height:100, axisTitlesPosition: 'none',
			chartArea: {left:"10%",top:0,width:500,height:"75%"},
			backgroundColor: { fill:'transparent' },
			vAxis: {title: "Exercices"},
			legend: {position: 'none'},
			hAxis: {maxValue: 100,  minValue: 0}
		};
		setBarChartOptions('../../chart/get_json_barchart_global.php?', optionsBarChart, 'barChart');
		</script>
		<div id="barChart" style="width: auto; height: auto;"></div>