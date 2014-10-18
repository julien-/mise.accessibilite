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
				</tr>
				</thead>
				<?php
				foreach ($listeBonus as $bonus)
				{
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