<?php 
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
			            	?>
			            		<i class="glyphicon glyphicon-user" title="<?php echo $createur->getPrenom(). " " .$createur->getNom();?>"></i>
			            	<?php 
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
                <h4 id="myModalLabel" class="modal-title">Ajouter un bonus au theme <?php echo $theme->getTitre();?></h4>
            </div>
            <form method="post" class="form_add_bonus" name="form_add_bonus" action="../Requete/rq_mes_bonus.php?section=mes_bonus&addbonus">
            	<div class="modal-body">
            		<div class="form-group">
            			<label for="titrebonus">Titre du Bonus</label>
	                	<input type="text" name="titrebonus" id="titrebonus" size="35" class="inputValDefaut">
	                </div>
	                <div class="form-group">
		                <label for="typebonus">Type de bonus</label>
		                <select class="test" name="typebonus">
		                	<option value="Expose">Exposé</option>
		                	<option value="Exercice">Exercice</option>
		                </select>	
		            </div> 
		            <div class="form-group">               	
		                <label for="collaborateursbonus">En collaboration avec</label>
		                <select class="collaborateurs" name="collaborateursbonus" id="collaborateurs<?php echo $theme->getId();?>" value="<?php echo $theme->getId();?>">
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
	           </div>
	           <div class="modal-footer">
                	<div id="donnees_cachees<?php echo $theme->getId();?>">
                	</div>
                	<input type="hidden" name="themebonus" value="<?php echo $theme->getId();?>"/>
                	<input type="submit" class="btn btn-primary" name="soumis1" id="soumis_bonus" alt='Ajouter le bonus' title='Ajouter le bonus' value="Ajouter"/>
                	<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    			</div>
	    	</form>
        </div>
     </div>
</div>  
<?php 
}
?>
