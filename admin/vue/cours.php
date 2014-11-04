<table class="interactive-table table table-bordered table-striped">
	<thead>
		<tr>
			<th>Cours</th>
			<th class="center-text">Inscrits</th>
			<th class="center-text">Nombre de thèmes</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	foreach($listeCours as $cours)
	{
	?>
		<tr>
			<td>
				<?php echo $cours->getLibelle(); ?>
			</td>
			<td class="autre_colonne">
				<?php echo $daoInscription->countByCours($cours->getId()); ?>
			</td>
			<td class="autre_colonne">
				<?php echo $daoTheme->countByCours($cours->getId()); ?>
			</td>
		</tr>
	<?php 
	}
	?>
	</tbody>
</table>