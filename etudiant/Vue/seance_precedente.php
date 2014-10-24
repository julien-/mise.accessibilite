<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../../js/googleChartToolsPieChart.js"></script>
<div class="row show-grid">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-comment"></i> Remarques sur cette séance
				</h3>
			</div>
			<div class="panel-body">
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
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-stats"></i> Progression globale lors de cette séance
				</h3>
			</div>
			<div class="panel-body">
				<div id="morris-area-chart">
					<script type="text/javascript">
		                var optionsPieChart =   {
		                                            is3D: 'false',
		                                            chartArea: {top:"5%", bottom:"5%",width:"100%", height:"90%"},
		                                            tooltip: {text: 'percentage' },
		                                            backgroundColor: { fill:'transparent' },
		                                            slices: {
		                                                0: { color: '#99FF33' },
		                                                1: { color: '#FF6633' }
		                                            }
		                                        };
		                setPieChartOptions('<?php echo $urlJSONPieChart;?>', optionsPieChart, "pieChart");
    		        </script>
					<div id="pieChart"></div>
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
				<tr class="titre">
				<th class="center-text">Exercice</th>
				<th class="center-text">Fait</th>
				<th class="center-text">Compris</th>
				<th class="center-text">Assimile</th>
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
			            <td class="autre_colonne">
			                <?php echo $avancement['exercice']['titre']; ?>
			            </td> 
			            <!--Fait-->
			            <td class="autre_colonne">
			            	<i class="<?php if($avancement_pourcentage >= 25) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Compris-->
			            <td class="autre_colonne">
			                 <i class="<?php if($avancement_pourcentage >= 50) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Assimile-->
			            <td class="autre_colonne">
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

