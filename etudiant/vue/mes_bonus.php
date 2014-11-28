<?php 
if ($bonusAdded)
{
	$alerte = new AlerteSuccess('Bonus ajouté !');
	$alerte->show();
}

foreach($listeThemes as $theme)
{
	$listeMesBonus = $daoAvancement_bonus->getByThemeEtudiantFait($theme->getId(),$_SESSION['currentUser']->getId());
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-th-list"></i> 
			<?php echo $theme->getTitre();?>
		</h3>
	</div>
	<div class="panel-body">
		<div id="morris-area-chart">
		<?php 
			if($listeMesBonus)
			{
		?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="titre">
						<th class="center-text">Titre</th>
						<th class="center-text">Type</th>
						<th class="center-text">Auteurs(s)</th>
						<th class="center-text">Moyenne</th>
					</tr>
				</thead>
				<?php
				foreach ($listeMesBonus as $bonus)
				{
					$moyenne = $daoAvancement_bonus->getMoyenneBonus($bonus->getId());
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
			            <!--Moyenne du bonus-->
			            <td class="autre_colonne">
			            	<?php echo round($moyenne,1)." / 5"; ?>
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
<a  class="btn btn-primary" data-toggle="modal" href="modal/remotePage.php" data-target="#ViewAjoutBonusTheme<?php echo $theme->getId();?>">Ajouter un bonus au theme <?php echo $theme->getTitre();?></a>  
<br/> 
<br/> 
<br/> 
<!-- Modal ajout Bonus-->  
<div class="modal fade" id="ViewAjoutBonusTheme<?php echo $theme->getId();?>" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">   
     <div class="modal-dialog">  
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Ajouter un bonus au theme <?php echo $theme->getTitre();?></h4>
            </div>
            <form method="post" name="<?php echo "form_add_bonus".$theme->getId();?>" action="../requete/rq_mes_bonus.php?addbonus">
            	<div class="modal-body">
            		<div class="form-group">
            			<label for="titrebonus" style="width:35%;">Titre du Bonus</label>
	                	<input type="text" name="titrebonus" id="titrebonus<?php echo $theme->getId();?>" class="inputValDefaut" style="width:64%;">
	                </div>
	                <div class="form-group">
		                <label for="typebonus" style="width:35%;">Type de bonus</label>
		                <select name="typebonus" style="width:35%;">
		                	<option value="Expose">Exposé</option>
		                	<option value="Exercice">Exercice</option>
		                </select>	
		            </div> 
		            <div class="form-group">               	
		                <label for="collaborateursbonus" style="width:35%;">En collaboration avec</label>
		                <select class="collaborateurs" name="collaborateursbonus" id="collaborateurs<?php echo $theme->getId();?>" value="<?php echo $theme->getId();?>" style="width:35%;">
	                		<option value=""></option>
	                		<?php 
	                		foreach ($listeInscritsExeptCurrentUser as $inscrit)
	                		{
	                		?>
	                			<option value="<?php echo $inscrit->getEtudiant()->getId();?>"><?php echo $inscrit->getEtudiant()->getPrenom()." ".$inscrit->getEtudiant()->getNom();?></option>
	                		<?php 
		                	}
	                		?>
	                	</select>
	                </div>	                	
                	<div id="liste_collaborateurs<?php echo $theme->getId();?>">                	
                	</div>
                	<br/>
					<br/>
                	<p></p>
	           </div>
	           <div class="modal-footer">
                	<div id="donnees_cachees<?php echo $theme->getId();?>">
                	</div>
                	<input type="hidden" name="themebonus" value="<?php echo $theme->getId();?>"/>
                	<input type="submit" class="soumettre_bonus btn btn-primary" id="<?php echo $theme->getId();?>" alt='Ajouter le bonus' title='Ajouter le bonus' value="Ajouter"/>
                	<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    			</div>
	    	</form>
        </div>
     </div>
</div>  
<?php 
}
?>
