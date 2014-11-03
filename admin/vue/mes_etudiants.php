<?php
if (sizeof($listeResultats) > 0)
{
?>
<table id="tableau" class="interactive-table table table-striped table-bordered">
	<thead>
		<tr>
			<th class="center-text">Nom</th>
			<th class="center-text">Pr&eacute;nom</th>
			<th class="center-text">Pseudo</th>
			<th class="center-text">D&eacute;tails</th>
		</tr>
	</thead>
	<tbody>
           		<?php
			foreach($listeResultats as $resultat)
			{
				?>
            <tr>
			<td class="autre_colonne">
                    <?php echo $resultat->getEtudiant()->getNom(); ?>
                </td>
			<td class="autre_colonne">
                    <?php echo $resultat->getEtudiant()->getPrenom(); ?>
                </td>
			<td class="autre_colonne">
                    <?php echo $resultat->getEtudiant()->getLogin(); ?>
                </td>
			<td class="autre_colonne"><a
				href="index.php?section=etudiant&e=<?php echo $resultat->getEtudiant()->getId(); ?>"><i class="glyphicon glyphicon-search" title="Cliquez pour plus de d&eacute;tails sur cette personne"></i></a></td>
		</tr>
                <?php
			}
				?>
        </tbody>
</table>
<?php 
}
?>