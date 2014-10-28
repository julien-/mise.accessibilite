<script type="text/javascript"
	src="../../../js/googleChartToolsPieChart.js"></script>
<script type="text/javascript"
	src="../../js/googleChartToolsColumnChart.js"></script>
<h1><?php echo $theme->getTitre(); ?></h1>
<div class="row">
<div class="col-lg-12 center-content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="fa fa-line-chart"></i> Progression globale de vos
				étudiants
			</h3>
		</div>
		<div class="panel-body">
			<div id="morris-area-chart">
				<div id="morris-area-chart">
					<script type="text/javascript" src="https://www.google.com/jsapi"></script>
					<script type="text/javascript">				            
                var optionsPieChart =   {
                                            is3D: 'false',
                                            chartArea: {left:"20%",top:50,width:"100%", height:"75%"},
                                            tooltip: {text: 'percentage' },
                                            backgroundColor: { fill:'transparent' },
                                            slices: {
                                                0: { color: '#99FF33' },
                                                1: { color: '#FF6633' }
                                            }
                                        };
                setPieChartOptions('../../chart/get_json_pie_chart.php?t=<?php echo $theme->getId();?>', optionsPieChart, "pieChart");
            </script>
					<div id="pieChart" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="row">
	<div class="col-lg-12 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-line-chart"></i> Progression par exercice
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<div id="morris-area-chart">
						<script type="text/javascript">	
				<?php
				$urlJSON = '../../chart/get_json_columnchart.php?theme=' . $theme->getId ();
				?>
	var optionsColumnChart = {
		width:"100%",	
		title: '<?php echo $theme->getTitre();?>',
		legend: { position: 'none'},
	    bar: { groupWidth: '75%' },
	    isStacked: true,
	    backgroundColor: { fill:'transparent' },
	    colors : ['#FF6633','#FFCC33','#99FF33'],
	    vAxis: {
	        maxValue: 100,
	        minValue: 0
	      }
	};
	
	setColumnChartOptions('<?php echo $urlJSON ?>', optionsColumnChart, 'exercices');
</script>

						<div id="exercices"
							style="margin-left: auto; margin-right: auto; width: 80%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
