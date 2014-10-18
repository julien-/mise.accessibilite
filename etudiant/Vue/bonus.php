<?php 
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
			            		<i class="glyphicon glyphicon-user" title="<?php echo $createur->getPrenom(). " " .$createur->getNom();?>"/>
			            	<?php 
				            	}
			            	?>
			            </td>
			            <!--Suivi-->
			            <td class="autre_colonne">
			            	<?php 
				            	if($mon_avancement['suivi'] != null)
				            	{
				            ?>
				            		<i class="glyphicon glyphicon-ok" />
				            <?php 
				            	}
				            	else
				            	{
	            			?>
	            					<input type="checkbox" name="suivi" class="inputValDefaut">
				          	<?php 
				            	}
			            	?>
			            </td>
			            <!--Moyenne du bonus-->
			            <td class="autre_colonne">
			            	<?php echo round($moyenne,1)." / 5"; ?>
			            </td>
			            <!--Note du bonus-->
			            <td class="autre_colonne">
			            	<?php 
				            	if($mon_avancement['note'] != null)
				            		echo $mon_avancement['note']." / 5";
				            	else
				            	{
	            			?>
	            					<select name="note">
	            					<?php 
	            					for($i=0; $i<=5 ; $i++)
	            					{
            						?>
									  	<option value = "<?php echo $i;?>"><?php echo $i;?></option>
									<?php 
	                   				}									
									?>
									</select>
				          	<?php 
				            	}
			            	?>
			            </td>
			            <!--Remarque du bonus-->
			            <td class="autre_colonne">	
			            	<?php 
			            		if($mon_avancement['remarque'] != null)
			            		{
			            	?>
				            	<a  class="btn btn-primary" data-toggle="modal" data-target="#ViewRemarque">?</a>  
	                
								<div class="modal fade" id="ViewRemarque" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
								     <div class="modal-dialog">  
								        <div class="modal-content">
								            <div class="modal-header">
								                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								                <h4 id="myModalLabel" class="modal-title">Remarque</h4>
								            </div>
								            <br/>
								            <?php echo $mon_avancement['remarque'] ?>
								            <br/>
								        </div>
								     </div>
								</div> 
							<?php 
			            		}
			            		else 
			            		{
	            			?>
			            			<a  class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#ViewAddRemarque" title="Ajouter une remarque"></a>  
	                
									<div class="modal fade" id="ViewAddRemarque" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
									     <div class="modal-dialog">  
									        <div class="modal-content">
									            <div class="modal-header">
									                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									                <h4 id="myModalLabel" class="modal-title">Ajouter une Remarque</h4>
									            </div>
									            <br/>
									            <form method="post" name="form_add_remarque" action="../Requete/rq_bonus.php?section=bonus&addbonus">
										            <div class="container-fluid">
									                	<div class="row">
									                		<div class="col-sm-1">
									                		</div>
									                		<div class="col-sm-9">
											            		<div class="form-group">
											            			<label for="remarque">Remarque : </label>
												                	<input type="text" name="remarque" id="remarque" size="60" value="" title="Taper une remarque" class="inputValDefaut"/>
												                </div>
												                <!--submit-->
												                <div class="form-group center-content">
																	<input type="hidden" name="id_bonus" value="<?php echo $bonus->getId();?>"/>
												                	<input type="submit" class="btn btn-primary" name="soumis1" id="soumis1" alt='Ajouter une remarque' title='Ajouter une remarque' value="Ajouter"/>
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
				?>
			</table>
			<?php 	
				}
				else 
					echo 'Aucun bonus';
			?>
		</div>
	</div>
</div>
<?php 
}
?>