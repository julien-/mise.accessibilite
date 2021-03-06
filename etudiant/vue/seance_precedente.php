<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../../js/googleChartToolsPieChart.js"></script>
<div class="row show-grid">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;Remarques sur cette séance
				</h3>
			</div>
			<div class="panel-body" style="height: 300px;">
				<div id="morris-area-chart">
					<?php 
						if($remarque)
							echo $remarque->getRemarque();
						else 
							echo "Aucune remarque n'avait été ajoutée lors de cette séance.";
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-pie-chart"></i>&nbsp;&nbsp;Progression globale lors de cette séance
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
			<i class="glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;Exercices du thème <?php echo $theme->getTitre();?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<?php				
			$listeExercice = $daoExercice->getByAllByTheme($theme->getId());
			if(sizeof($listeExercice) > 0)
			{
			?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-xs-6 col-sm-6 center-text">Exercice</th>
						<th class="col-xs-2 col-sm-2 center-text">Fait</th>
						<th class="col-xs-2 col-sm-2 center-text">Compris</th>
						<th class="col-xs-2 col-sm-2 center-text">Assimilé</th>
					</tr>
				</thead>
				<?php					
				foreach ( $listeExercice as $exercice )
				{
					$avancement = $daoAvancement->getBySeanceExerciceEtudiant($_GET["id_seance"], $exercice->getId(), $_SESSION['currentUser']->getId());
				?>
			    <tbody>
			        <tr>
			            <!--Titre de l'exercice-->
			            <td class="col-xs-6 col-sm-6">
			                <?php echo $exercice->getTitre(); ?>
			            </td> 
			            <!--Fait-->
			            <td class="col-xs-2 col-sm-2 center-text">
			            	<i class="<?php if($avancement >= 25) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Compris-->
			            <td class="col-xs-2 col-sm-2 center-text">
			                 <i class="<?php if($avancement >= 50) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			            <!--Assimile-->
			            <td class="col-xs-2 col-sm-2 center-text">
			                 <i class="<?php if($avancement == 100) echo "glyphicon glyphicon-ok"; else echo "glyphicon glyphicon-remove";?>"></i>
			            </td>
			        </tr>
			    </tbody>
				<?php 
				} 
				?>
			</table>
			<?php 
			}
			else 
			{
				echo "Aucun exercice dans ce thème";
			}
			?>
		</div>
	</div>
</div>
<?php 
}
?>

