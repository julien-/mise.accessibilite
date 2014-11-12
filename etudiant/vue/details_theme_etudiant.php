<script type="text/javascript" src='../../js/googleChartAPI.js'></script>
<script type="text/javascript" src="../../js/googleChartToolsLineChart.js"></script>
<script type="text/javascript" src="../../js/googleChartToolsColumnChart.js"></script>
<h1><?php echo $theme->getTitre();?></h1>
<div class="row">
	<div class="col-lg-12 center-content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-level-up"></i> Progression totale dans ce thème
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<div id="morris-area-chart">
						<div class="progress progress-striped progress-borders"
							style="margin-top: 12px;">
							<div class="progress-bar progress-bar-primary vert-align" 
                                    style="color: black; background-color: <?php echo Outils::colorChart($progression_theme); ?>; width: <?php echo $progression_theme; ?>%;">
                                    	<?php echo $progression_theme; ?> %
                                    </div>
						</div>
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
				$urlJSON = '../../chart/get_json_columnchart.php?e=' . $_SESSION['currentUser']->getId() . '&theme=' . $theme->getId ();
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