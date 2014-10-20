<?php 
//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
	echo ($_SESSION["notif_msg"]);
	$_SESSION["notif_msg"] = "";
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
						<th class="center-text">Créateur(s)</th>
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
            <br/>
            	<div class="container-fluid">
                	<div class="row">
                		<div class="col-sm-1">
                		</div>
                		<div class="col-sm-9">
	            		<div class="form-group">
	            			<label for="titrebonus">Titre du Bonus</label>
		                	<input type="text" name="titrebonus" id="titrebonus" size="26" class="inputValDefaut">
		                </div>
		                <div class="form-group">
		                	<label for="typebonus">Type de bonus</label>
		                	<select name="typebonus">
		                		<option value="Expose">Exposé</option>
		                		<option value="Exercice">Exercice</option>
		                	</select>	                	
		                </div>
		                <!--submit-->
		                <div class="form-group center-content">
		                	<input type="hidden" name="themebonus" value="<?php echo $theme->getId();?>"/>
		                	<input type="submit" class="btn btn-primary" name="soumis1" id="soumis_bonus" alt='Ajouter le bonus' title='Ajouter le bonus' value="Ajouter"/>
		    			</div>
		    			</div>
		    			<div class="col-sm-1">
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