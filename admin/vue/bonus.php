<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="glyphicon glyphicon-th-list"></i> 
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
			        </tr>
			    </tbody>
				<?php 
				}
				?>
			</table>
			<?php 	
			}
			?>
		</div>
	</div>
</div>
