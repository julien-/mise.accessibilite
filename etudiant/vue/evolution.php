<script type="text/javascript"
  src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1","packages":["corechart","table"]}]}'>
</script>
<script type="text/javascript" src="../../js/googleChartToolsBarChart.js"></script>
<script type="text/javascript" src="../../js/googleChartToolsColumnChart.js"></script>

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

<?php 
if(!empty($listeThemes))
{
?>
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
<?php
}
?>

<!-- Avancement global -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-align-left"></i>&nbsp;&nbsp;Avancement Global
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<div id="barChart"></div>
		</div>
	</div>
</div>

<!-- Visualisation Badges -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-leaf"></i>&nbsp;&nbsp;Mes Badges
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<?php 
			$minimum_un_objectif = false;
			foreach ($listeAssignationsObjectifs as $assignation)
			{
				if ($assignation->getPourcentage() >= 100)
				{
					$objectif = str_replace(' ', '_', $assignation->getObjectif()->getObjectif()); 
					$objectif = stripAccents($objectif);
			?>
				
					<div class="col-xs-4 col-sm-2 text-center">
						<img src="<?php echo '../../images/Badges/' . $objectif . '.png'; ?>" alt="<?php echo $assignation->getObjectif()->getObjectif(); ?>" title="<?php echo $assignation->getObjectif()->getDescription(); ?>" />
						<br>
						<span class="bold"><?php echo $assignation->getObjectif()->getObjectif(); ?></span>
					</div>
			<?php 
					$minimum_un_objectif= true;
				}
			}
			if(!$minimum_un_objectif)
			{
			?>
				<span>Aucun badge n'a encore été obtenu, voir la liste des badges dans le menu Mes Badges</span>
			<?php 
			}
			?>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-stats"></i>&nbsp;&nbsp;Mon Evolution par Thême
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<?php 
			if(!empty($listeThemes))
			{
			?>
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
			<?php 						
			}
			else 
			{
			?>
				<span>Aucun Thème n'a été créé par l'enseignant du cours</span>
			<?php 
			}
			?>
		</div>
	</div>
</div>