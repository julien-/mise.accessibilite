<?php 
//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
	echo ($_SESSION["notif_msg"]);
	$_SESSION["notif_msg"] = "";
}

foreach($listeThemes as $theme)
{
	$listeBonus = $daoBonus->getAllByTheme($theme->getId());
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
			if($listeBonus)
			{
			?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="titre">
						<th class="center-text">Titre</th>
						<th class="center-text">Type</th>
						<th class="center-text">Créateur(s)</th>
						<th class="center-text">Suivi</th>
						<th class="center-text">Moyenne</th>
						<th class="center-text">Ma Note</th>
						<th class="center-text">Ma Remarque</th>
					</tr>
				</thead>
				<?php
				foreach ($listeBonus as $bonus)
				{
					if(!$daoAvancement_bonus->VerifCreateur($bonus->getId(), $_SESSION['currentUser']->getId()))
					{
						$moyenne = $daoAvancement_bonus->getMoyenneBonus($bonus->getId());
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
				            	?>
				            		<i class="glyphicon glyphicon-user" title="<?php echo $createur->getPrenom(). " " .$createur->getNom();?>"></i>
				            	<?php 
					            	}
				            	?>
				            </td>
				            <!--Suivi-->
				            <td class="autre_colonne">
	            				<form method="post" name="form_add_suivi" action="../Requete/rq_autres_bonus.php?section=autres_bonus&addsuivi">
	            					<input type="hidden" name="id_bonus" value="<?php echo $bonus->getId();?>"/>
	            					<input type="checkbox" name="<?php echo "bonus_suivi".$bonus->getId();?>" onClick=<?php if($mon_avancement['suivi'] != null) echo "'return false'"; else echo "'this.form.submit()'"?> <?php if($mon_avancement['suivi'] != null) echo "checked='checked'";?>/>
	            				</form>
				            </td>
				            <!--Moyenne du bonus-->
				            <td class="autre_colonne">
				            	<?php echo round($moyenne,1)." / 5"; ?>
				            </td>
				            <!--Note du bonus-->
				            <td class="autre_colonne">
	            				<form method="post" name="<?php echo "form_add_note".$bonus->getId();?>" action="../Requete/rq_autres_bonus.php?section=autres_bonus&addnote">
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
					            		<a  id="voir_remarque" class="glyphicon glyphicon-search" data-toggle="modal" data-target="#ViewRemarqueBonus<?php echo $bonus->getId();?>" title="Voir ma remarque" value="<?php echo $mon_avancement['remarque'];?>"></a>   		
										
										<!-- Popup Affichache remarque -->
										<div class="modal fade" id="ViewRemarqueBonus<?php echo $bonus->getId();?>" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
										     <div class="modal-dialog">  
										        <div class="modal-content">
										            <div class="modal-header">
										                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
										                <h4 id="myModalLabel" class="modal-title">Ma Remarque</h4>
										            </div>
										            <br/>
										            <div class="container-fluid">
										                <div class="row">
										                	<div class="col-sm-1">
										                	</div>
										                	<div id="afficherremarque" class="col-sm-9">
										                		<?php echo $mon_avancement['remarque'];?>
										            			<div class="col-sm-1">
													    		</div>
										            		</div>            			
										            	</div>
										            </div>
										        </div>
										     </div>
										</div> 
								<?php 
				            		}
				            		else 
				            		{
		            			?>
				            			<a id="ajouter_remarque" value="<?php echo $bonus->getId();?>" class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#ViewAddRemarqueBonus<?php echo $bonus->getId();?>" title="Ajouter une remarque"></a>  
				            			
				            			<!-- Popup Ajout remarque -->
										<div class="modal fade" id="ViewAddRemarqueBonus<?php echo $bonus->getId();?>" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
										     <div class="modal-dialog">  
										        <div class="modal-content">
										            <div class="modal-header">
										                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
										                <h4 id="myModalLabel" class="modal-title">Ajouter une Remarque</h4>
										            </div>
										            <br/>
										            <form method="post" name="form_add_remarque" action="../Requete/rq_autres_bonus.php?section=autres_bonus&addremarque">
											            <div class="container-fluid">
										                	<div class="row">
										                		<div class="col-sm-1">
										                		</div>
										                		<div class="col-sm-9">
												            		<div class="form-group">
												            			<label for="remarque">Remarque : </label>
													                	<input type="text" name="remarque" id="remarque" size="60" class="inputValDefaut"/>
													                </div>
													                <!--submit-->
													                <div class="form-group center-content">
																		<input type="hidden" name="id_bonus" value="<?php echo $bonus->getId();?>"/>
													                	<input type="submit" class="btn btn-primary" name="soumis1" id="soumis_remarque" alt='Ajouter une remarque' title='Ajouter une remarque' value="Ajouter"/>
													    			</div>
													    			<div class="col-sm-1">
													    			</div>
												    			</div>
											    			</div>
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



