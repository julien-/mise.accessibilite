<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../../js/googleChartToolsPieChart.js"></script>
<?php 
if ($remarqueAdded)
{
	$alerte = new AlerteSuccess('Remarque ajoutée !');
	$alerte->show();
}

if ($remarqueModified)
{
	$alerte = new AlerteSuccess('Remarque modifiée !');
	$alerte->show();
}

if ($avancementModified)
{
	$alerte = new AlerteSuccess('Progression mise à jours avec succès !');
	$alerte->show();
}
?>
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
						{
							echo $remarque->getRemarque();
						?>
							&nbsp;<a class="pointer" data-toggle="modal" data-target="#ViewModifyRemarqueBonus" title="Modifier la remarque"><i class="glyphicon glyphicon-pencil"></i></a> 
							
							<!-- Popup Ajout remarque -->
							<div class="modal fade" id="ViewModifyRemarqueBonus" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
							     <div class="modal-dialog">  
								 	<div class="modal-content">
							            <div class="modal-header">
							                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							                <h4 id="myModalLabel" class="modal-title">Modification de la Remarque</h4>
							            </div>
							            <form method="post" name="form_modify_remarque" action="../requete/rq_seance_actuelle.php?modifyremarque">
											<div class="modal-body">
												<textarea name="remarque" style="width:100%; height:100px; resize:vertical;"><?php echo $remarque->getRemarque();?></textarea>
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
							            <form method="post" name="form_add_remarque" action="../requete/rq_seance_actuelle.php?addremarque">
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
					<i class="fa fa-pie-chart"></i>&nbsp;Progression globale lors de cette séance
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

<form method="post" name="form_maj_avancement" action="../requete/rq_seance_actuelle.php?maj_avancement">
	<div id="nav">
	  <input type="submit" class="btn btn-primary" name="soumis" id="soumis_avancement" alt='Mettre à jour avancement' title='Mettre à jour avancement' value="Sauvegarder ma progression"/>
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
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-xs-4 col-sm-4 center-text">Exercice</th>
						<th class="col-xs-2 col-sm-2 center-text">Aide</th>
						<th class="col-xs-2 col-sm-2 center-text">Fait</th>
						<th class="col-xs-2 col-sm-2 center-text">Compris</th>
						<th class="col-xs-2 col-sm-2 center-text">Assimile</th>
					</tr>
				</thead>
				<?php				
				$listeExercice = $daoExercice->getByAllByTheme($theme->getId());
				foreach ( $listeExercice as $exercice )
				{
					$avancement = $daoAvancement->getByExerciceEtudiant($exercice->getId(), $_SESSION['currentUser']->getId());			
					$listeFichiers = $daoFichiers->getAllByExercice ($exercice->getId());
				?>
			    <tbody>
			        <tr>
			            <!--Titre de l'exercice-->
			            <td class="col-xs-4 col-sm-4">
			                <a class="pointer base titre" data-toggle="collapse" data-target="#bloc-<?php echo $exercice->getId(); ?>">
								<?php echo $exercice->getTitre(); ?>&nbsp;<b class="caret"></b>
							</a>
							<div id="bloc-<?php echo $exercice->getId(); ?>" class="collapse">
								<?php 
								if (sizeof($listeFichiers) > 0)
								{
								?>
									<p class="no_results">Fichier(s)</p>
									<ul>
								<?php
									foreach ( $listeFichiers as $fichier ) 
									{
										if($fichier->getEnLigne() == 1)
										{
								?>
											<li>
												<a href="../../controleur/download.php?f=<?php echo $fichier->getCodeLien();?>"><?php echo $fichier->getNom();?></a>
											</li>
			        			<?php 
										}
									}
								?>
									</ul>
								<?php
								}
								else 
								{
								?>
									<p class="no_results">Aucun fichier pour cet exercice</p>
								<?php 
								}
								?>
			        		</div>							
			            </td> 
			            <!--Aide-->
			            <td class="col-xs-2 col-sm-2 center-text">
			            	<a class="pointer" data-toggle="modal" data-target="#ViewAideExercice<?php echo $exercice->getId();?>" title="Obtenir de l'aide pour cet exercice"><i class="glyphicon glyphicon-user"></i> </a>
			            	<!-- Popup Aide -->
							<div class="modal fade" id="ViewAideExercice<?php echo $exercice->getId();?>" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
							     <div class="modal-dialog">  
								 	<div class="modal-content">
							            <div class="modal-header">
							                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							                <h4 id="myModalLabel" class="modal-title">Obtenir de l'aide pour l'exercice : <?php echo $exercice->getTitre();?></h4>
							            </div>
										<div class="modal-body">
											liste des étudiants qui ont assimilé l'exercice : 
											<br><br>
											
					                		<?php 
				                			$listeEtudiants = $daoAvancement->getAssimileByExercice($exercice->getId());
				                			if ($listeEtudiants != null)
				                			{
					                		?>
				                				<table id="tableau" class="interactive-table table table-striped table-bordered table-hover">
													<thead>
														<tr class="titre">
															<th class="center-text">Etudiant</th>
															<th class="center-text">Le contacter</th>
														</tr>
													</thead>
													<tbody>
													<?php 
						                				foreach($listeEtudiants as $etudiant)
						                				{
					                					?>
						                					<tr>
        														<td class="autre_colonne">
	        													<?php 
							                						echo $etudiant->getPrenomNom();
							                					?>
						                						</td>
						                						<td class="autre_colonne">
						                							<i class="glyphicon glyphicon-envelope"></i>
						                						</td>
						                					</tr>
					                					<?php
						                				}
						                				?>
					                				</tbody>
				                				</table>
						                	<?php
				                			}
				                			else 
				                			{
				                				echo "Aucun étudiant n'a assimilé cet exercice";
				                			}
					                		?>	
						                </div>
						                <div class="modal-footer">
					                		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					    				</div>
							        </div>
								</div>
							</div>  
			            </td>
			            <!--Fait-->
			            <td class="col-xs-2 col-sm-2 center-text">
			            	<input type="checkbox" class="fait" id="fait<?php echo $exercice->getId();?>" value="<?php echo $exercice->getId();?>" <?php if($avancement >= 25) echo 'onClick="return false" checked="checked" title="L\'exercice a été fait à une séance précédente"'; else echo 'name="fait[]"';?>/>		            	
			            </td>
			            <!--Compris-->
			            <td class="col-xs-2 col-sm-2 center-text">
			                <input type="checkbox" class="compris" id="compris<?php echo $exercice->getId();?>" value="<?php echo $exercice->getId();?>" <?php if($avancement >= 50) echo 'onClick="return false" checked="checked" title="L\'exercice a été compris à une séance précédente"'; else echo 'name="compris[]"';?>/>	
		            	</td>
			            <!--Assimile-->
			            <td class="col-xs-2 col-sm-2 center-text">
			                <input type="checkbox" class="assimile" id="assimile<?php echo $exercice->getId();?>" value="<?php echo $exercice->getId();?>" <?php if($avancement == 100) echo 'onClick="return false" checked="checked" title="L\'exercice a été assimile à une séance précédente"'; else echo 'name="assimile[]"';?>/>	
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
<input type="hidden" name="id_seance" value="<?php echo $id_seance;?>"/>
</form>

