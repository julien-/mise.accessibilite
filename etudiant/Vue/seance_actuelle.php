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
						{
							echo $remarque->getRemarque();
						?>
							<a class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#ViewModifyRemarqueBonus" title="Modifier la remarque"></a> 
							
							<!-- Popup Ajout remarque -->
							<div class="modal fade" id="ViewModifyRemarqueBonus" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
							     <div class="modal-dialog">  
								 	<div class="modal-content">
							            <div class="modal-header">
							                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							                <h4 id="myModalLabel" class="modal-title">Modifier la Remarque</h4>
							            </div>
							            <form method="post" name="form_modify_remarque" action="../Requete/rq_seance_actuelle.php?section=seance_actuelle&modifyremarque">
											<div class="modal-body">
						                		<input type="text" name="remarque" size="60" value="<?php echo $remarque->getRemarque();?>" class="inputValDefaut"/>
							                </div>
							                <div class="modal-footer">
												<input type="hidden" name="id_seance" value="<?php echo $id_seance;?>"/>
						                		<input type="submit" class="btn btn-primary" name="soumis1" id="soumis_remarque" alt='Modifier la remarque' title='Modifier la remarque' value="Modifier"/>
						                		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						    				</div>
							            </form>
							        </div>
								</div>
							</div>  
						<?php 
						}
						else 
						{
							echo "Aucune remarque";
						?>
							<a class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#ViewAddRemarqueBonus" title="Ajouter une remarque"></a> 
							
							<!-- Popup Ajout remarque -->
							<div class="modal fade" id="ViewAddRemarqueBonus" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
							     <div class="modal-dialog">  
								 	<div class="modal-content">
							            <div class="modal-header">
							                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							                <h4 id="myModalLabel" class="modal-title">Ajouter une Remarque</h4>
							            </div>
							            <form method="post" name="form_add_remarque" action="../Requete/rq_seance_actuelle.php?section=seance_actuelle&addremarque">
											<div class="modal-body">
						                		<input type="text" name="remarque" size="60" class="inputValDefaut"/>
							                </div>
							                <div class="modal-footer">
												<input type="hidden" name="id_seance" value="<?php echo $id_seance;?>"/>
						                		<input type="submit" class="btn btn-primary" name="soumis1" id="soumis_remarque" alt='Ajouter une remarque' title='Ajouter une remarque' value="Ajouter"/>
						                		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						    				</div>
							            </form>
							        </div>
								</div>
							</div>  
						<?php 
						}
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

<form method="post" name="form_maj_avancement" action="../Requete/rq_seance_actuelle.php?section=seance_actuelle&maj_avancement">
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
				$i = 0;
				$listeAvancement = $daoAvancement->getTabBySeanceThemeEtudiant($id_seance, $theme->getId(), $_SESSION["currentUser"]->getId());
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
			            <td class="prem_colonne">
			                <?php echo $avancement['exercice']['titre']; ?>
			            </td> 
			            <!--Fait-->
			            <td class="autre_colonne">
			            	<input type="checkbox" class="fait" id="fait<?php echo $avancement['exercice']['id'];?>" data-sc="<?php echo $i; ?>" value="<?php echo $avancement['exercice']['id']?>" <?php if($avancement_pourcentage >= 25) echo 'onClick="return false" checked="checked" title="L\'exercice a été fait à une séance précédente"'; else echo 'name="fait[]"';?>/>		            	
			            </td>
			            <!--Compris-->
			            <td class="autre_colonne">
			                <input type="checkbox" class="compris" id="compris<?php echo $avancement['exercice']['id'];?>" data-sc="<?php echo $i; ?>" value="<?php echo $avancement['exercice']['id']?>" <?php if($avancement_pourcentage >= 50) echo 'onClick="return false" checked="checked" title="L\'exercice a été compris à une séance précédente"'; else echo 'name="compris[]"';?>/>	
		            	</td>
			            <!--Assimile-->
			            <td class="autre_colonne">
			                <input type="checkbox" class="assimile" id="assimile<?php echo $avancement['exercice']['id'];?>" data-sc="<?php echo $i; ?>" value="<?php echo $avancement['exercice']['id']?>" <?php if($avancement_pourcentage == 100) echo 'onClick="return false" checked="checked" title="L\'exercice a été assimile à une séance précédente"'; else echo 'name="assimile[]"';?>/>	
			            </td>
			        </tr>
			    </tbody>
				<?php 
				$i++;
				} 
				?>
			</table>
		</div>
	</div>
</div>
<?php 
}
?>
<input type="hidden" name="id_seance" value="<?php echo $id_seance;?>"/>
<input type="submit" class="btn btn-primary" name="soumis" id="soumis_avancement" alt='Mettre à jour avancement' title='Mettre à jour avancement' value="Envoyer"/>
</form>

