<script type="text/javascript"
  src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'>
</script>
<script type="text/javascript" src="../../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript" src="../../js/googleChartToolsColumnChart.js"></script>

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

<script type="text/javascript">	
<?php 
foreach($listeThemes as $theme)
{
	$urlJSON = '../../chart/get_json_columnchart.php?e='.$_SESSION['currentUser']->getId().'&theme='.$theme->getId();
?>
	var optionsColumnChart = {
		width:"100%",	
		title: '<?php echo $theme->getTitre();?>',
		legend: { position: 'none'},
	    bar: { groupWidth: '75%' },
	    isStacked: true,
	    tooltip: {isHtml: true}, 
	    backgroundColor: { fill:'transparent' },
	    colors : ['#FF6633','#FFCC33','#99FF33'],
	    vAxis: {
	        maxValue: 100,
	        minValue: 0
	      }
	};
	
	setColumnChartOptions('<?php echo $urlJSON ?>', optionsColumnChart, '<?php echo $theme->getId();?>');
<?php
}
?>
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

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-stats"></i> Mon Evolution par Thême
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				  	<?php 
				  	$i = 0;
					foreach($listeThemes as $theme)
					{
					?>
					    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) echo "class=\"active\"";?>></li>
				    <?php 						
						$i++;
					}
					?>
				  </ol>
				
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner pokemon-red">
				  	<?php 
				  	$i = 0;
					foreach($listeThemes as $theme)
					{
					?>
						<div class="<?php if($i == 0) echo "item active"; else echo "item";?>">
				      		<div id="<?php echo $theme->getId();?>" style="margin-left: auto; margin-right: auto; width: 80%;"></div>
				    	</div>
					<?php 						
						$i++;
					}
					?>
				  </div>
				
				  <!-- Controls -->
				  <a style="background-image: none;" class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				    <span class="pokemon-red glyphicon glyphicon-chevron-left"></span>
				  </a>
				  <a style="background-image: none;" class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="pokemon-red glyphicon glyphicon-chevron-right"></span>
				  </a>
			</div>
		</div>
	</div>
</div>




