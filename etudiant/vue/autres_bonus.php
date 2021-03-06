<?php 
if ($remarqueAdded)
{
	$alerte = new AlerteSuccess('Remarque ajoutée !');
	$alerte->show();
}

if ($noteAdded)
{
	$alerte = new AlerteSuccess('Note ajoutée !');
	$alerte->show();
}

if ($suiviAdded)
{
	$alerte = new AlerteSuccess('Suivi ajouté !');
	$alerte->show();
}

foreach($listeThemes as $theme)
{
	$listeBonus = $daoBonus->getAllByThemeExceptMine($theme->getId(), $_SESSION['currentUser']->getId());	
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-th-list"></i> <?php echo $theme->getTitre();?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
			<?php 
			if(sizeof($listeBonus) > 0)
			{
			?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="titre">
						<th class="center-text">Titre</th>
						<th class="center-text">Type</th>
						<th class="center-text">Créateur(s)</th>
						<th class="center-text">Suivi</th>
						<th class="center-text">Ma Note</th>
						<th class="center-text">Ma Remarque</th>
					</tr>
				</thead>
				<?php
				foreach ($listeBonus as $bonus)
				{
						$mon_avancement = $daoAvancement_bonus->getByEtudiantBonus($_SESSION['currentUser']->getId(), $bonus->getId());
						$liste_createurs = $daoAvancement_bonus->getCreateurs($bonus->getId());
				?>
				    <tbody>
				        <tr>
				            <!--Titre du bonus-->
				            <td class="autre_colonne">
				                <?php echo $bonus->getTitre(); ?>
				            </td> 
				            <!--Type du bonus-->
				            <td class="autre_colonne">
				            	<?php echo $bonus->getType(); ?>
				            </td>
				            <!--Créateurs du bonus-->
				            <td class="autre_colonne">
				            	<?php 
				            		foreach($liste_createurs as $createur)
				            		{
										if($createur->getCode_lien() != NULL)
										{
											$chemin = $daoEtudiant->getCheminByCodeLienAndEtu($createur->getCode_lien(),$createur->getId());
								?>
											<img class="profile-image img-circle" width="20" height="20" src="../../upload/<?php echo $chemin; ?>" alt="avatar" title="<?php echo $createur->getPrenomNom();?>"/>
								<?php 
										}
										else 
										{
								?>
					            			<i class="glyphicon glyphicon-user" title="<?php echo $createur->getPrenomNom();?>"></i>
				            	<?php 
										} 
					            	}
				            	?>
				            </td>
				            <!--Suivi-->
				            <td class="autre_colonne">
	            				<form method="post" name="form_add_suivi" action="../requete/rq_autres_bonus.php?addsuivi">
	            					<input type="hidden" name="id_bonus" value="<?php echo $bonus->getId();?>"/>
	            					<input type="checkbox" name="<?php echo "bonus_suivi".$bonus->getId();?>" onClick=<?php if($mon_avancement['suivi'] != null) echo "'return false'"; else echo "'this.form.submit()'"?> <?php if($mon_avancement['suivi'] != null) echo "checked='checked'";?>/>
	            				</form>
				            </td>
				            <!--Note du bonus-->
				            <td class="autre_colonne">
	            				<form method="post" name="<?php echo "form_add_note".$bonus->getId();?>" action="../requete/rq_autres_bonus.php?addnote">
	            					<input type="hidden" name="id_bonus" value="<?php echo $bonus->getId();?>"/>
	            					<select class="note" name="note" id="<?php echo "note".$bonus->getId();?>" value="<?php echo $bonus->getId();?>">
	            					<?php 
		            				for($i=0; $i<=5 ; $i++)
		            				{
	            					?>
									  	<option value = "<?php echo $i;?>" <?php if($mon_avancement['note'] != null && $mon_avancement['note'] == $i) echo "selected"?>><?php echo $i;?></option>
									<?php 
	                   				}									
									?>
									</select>
								</form>
				            </td>
				            <!--Remarque du bonus-->
				            <td class="autre_colonne">	
				            	<?php 
				            		if($mon_avancement['remarque'] != null)
				            		{
				            	?>
					            		<a class="voir_remarque glyphicon glyphicon-search" data-toggle="modal" data-target="#ViewRemarqueBonus<?php echo $bonus->getId();?>" title="Voir ma remarque"></a>   		
										
										<!-- Popup Affichache remarque -->
										<div class="modal fade" id="ViewRemarqueBonus<?php echo $bonus->getId();?>" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
										     <div class="modal-dialog">  
										        <div class="modal-content">
										            <div class="modal-header">
									                	<button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									                	<h4 class="modal-title">Ma Remarque</h4>
										            </div>
										            <div class="modal-body" >
										            	<textarea style="width:100%; resize:vertical;" rows="4" readonly><?php echo $mon_avancement['remarque'];?></textarea>
										            </div>
										            <div class="modal-footer">
										        		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										      		</div>
										        </div>
										     </div>
										</div> 									
								<?php 
				            		}
				            		else 
				            		{
		            			?>
				            			<a class="ajouter_remarque glyphicon glyphicon-pencil" data-toggle="modal" data-target="#ViewAddRemarqueBonus<?php echo $bonus->getId();?>" title="Ajouter une remarque" value="<?php echo $bonus->getId();?>"></a>  
				            			
				            			<!-- Popup Ajout remarque -->
										<div class="modal fade" id="ViewAddRemarqueBonus<?php echo $bonus->getId();?>" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
										     <div class="modal-dialog">  
										        <div class="modal-content">
										            <div class="modal-header">
										                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
										                <h4 class="modal-title">Ajouter une Remarque</h4>
										            </div>
										            <form method="post" name="<?php echo "form_add_remarque".$bonus->getId();?>" action="../requete/rq_autres_bonus.php?addremarque">
														<div id="message<?php echo $bonus->getId();?>" class="modal-body">
									                		<textarea name="remarque" id="remarque<?php echo $bonus->getId();?>" style="width:100%; resize:vertical;" rows="4"><?php echo $mon_avancement['remarque'];?></textarea>
										                </div>
										                <div class="modal-footer">
															<input type="hidden" name="id_bonus" value="<?php echo $bonus->getId();?>"/>
										                	<input type="submit" class="soumettre_remarque btn btn-primary" id="<?php echo $bonus->getId();?>" alt='Ajouter une remarque' title='Ajouter une remarque' value="Ajouter"/>
										                	<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										    			</div>
										            </form>
										        </div>
										     </div>
										</div> 
				            	<?php 
				            		}
								?> 			
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
				echo "Aucun bonus dans le theme ".$theme->getTitre();
			?>
		</div>
	</div>
</div>
<?php 
}
?>



