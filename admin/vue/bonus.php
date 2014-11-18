<?php 
foreach($listeThemes as $theme)
{
	if (!isset($_GET['e']))
		$listeMesBonus = $daoAvancementBonus->getByThemeFait($theme->getId());
	else	
		$listeMesBonus = $daoAvancementBonus->getByThemeEtudiantFait($theme->getId(),$_GET['e']);
?>
	<div class="panel panel-default" style="border-color: #5b5281;">
		<div class="panel-heading" style="background-color: #5b5281; color: white; font-weight: bold;">
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
						<th class="center-text">Supprimer</th>
					</tr>
				</thead>
				<?php
				foreach ($listeMesBonus as $bonus)
				{
					$moyenne = $daoAvancementBonus->getMoyenneBonus($bonus->getId());
					$liste_createurs = $daoAvancementBonus->getCreateurs($bonus->getId());
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
			            <td class="autre_colonne">
			            	<a href="../controleur/delete.php?bonus=<?php echo($bonus->getId()); ?>">
			            		<i class="glyphicon glyphicon-minus-sign" alt="Supprimer" title="Supprimer"></i>
			            	</a>
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
