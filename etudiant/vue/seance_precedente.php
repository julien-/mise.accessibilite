<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../../js/googleChartToolsPieChart.js"></script>
<div class="row show-grid">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-comment"></i> Remarques sur cette séance
				</h3>
			</div>
			<div class="panel-body" style="height: 300px;">
				<div id="morris-area-chart">
					<?php 
						if($remarque)
							echo $remarque->getRemarque();
						else 
							echo "Aucune remarque";
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-stats"></i> Progression globale lors de cette séance
				</h3>
			</div>
			<div class="panel-body" style="height: 300px;">
				<div id="morris-area-chart">
					<script type="text/javascript">
		                var optionsPieChart =   {
		                                            is3D: 'false',
		                                            chartArea: {top:"5%", bottom:"5%",width:"90%", height:"90%"},
		                                            tooltip: {text: 'percentage' },
		                                            backgroundColor: { fill:'transparent' },
		                                            slices: {
		                                                0: { color: '#99FF33' },
		                                                1: { color: '#FF6633' }
		                                            }
		                                        };
		                setPieChartOptions('<?php echo $urlJSONPieChart;?>', optionsPieChart, "pieChart");
    		        </script>
					<div id="pieChart" style="height: 300px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php 
foreach($listeThemes as $theme)
{
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-th-list"></i> <?php echo $theme->getTitre();?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-xs-6 col-sm-6 center-text">Exercice</th>
						<th class="col-xs-2 col-sm-2 center-text">Fait</th>
						<th class="col-xs-2 col-sm-2 center-text">Compris</th>
						<th class="col-xs-2 col-sm-2 center-text">Assimile</th>
					</tr>
				</thead>
				<?php
				$listeAvancement = $daoAvancement->getTabBySeanceThemeEtudiant($_GET["id_seance"], $theme->getId(), $_SESSION["currentUser"]->getId());
				foreach ($listeAvancement as $avancement)
				{
					$avancement_pourcentage = 0;
					if($avancement['fait'] == 25)
						$avancement_pourcentage = 25;
					elseif($avancement['compris'] == 25)
						$avancement_pourcentage = 50;
					elseif($avancement['assimile'] == 50)
						$avancement_pourcentage = 100;
				?>
			    <tbody>
			        <tr>
			            <!--Titre de l'exercice-->
			            <td class="col-xs-6 col-sm-6">
			                <?php echo $avancement['exercice']['titre']; ?>
			            </td> 
			            <!--Fait-->
			            <td class="col-xs-2 col-sm-2 center-text">
			            	<i class="<?php if($avancement_pourcentage >= 25) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Compris-->
			            <td class="col-xs-2 col-sm-2 center-text">
			                 <i class="<?php if($avancement_pourcentage >= 50) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Assimile-->
			            <td class="col-xs-2 col-sm-2 center-text">
			                 <i class="<?php if($avancement_pourcentage == 100) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			        </tr>
			    </tbody>
				<?php 
				} 
				?>
			</table>
		</div>
	</div>
</div>
<?php 
}
?>

