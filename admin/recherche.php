<?php
if (isset ( $_GET ['section'] ) && $_GET ['section'] == 'recherche') {
	$titre = "<h1 class=\"titre_page_school\">Mes &eacute;tudiants</h1>";
	$pRetour = "index.php?section=recherche";
} else {
	$titre = "<h2 class=\"titre_scolaire\">Recherche d'&eacute;tudiant</h2>";
	$pRetour = "index.php?r=1";
}
echo $titre;

$reqRecherche = SQLQuery ( 'SELECT * FROM etudiant e, inscription i, cours c WHERE e.id_etu = i.id_etu AND c.id_cours = i.id_cours AND c.id_prof = ' . $_SESSION ['currentUser']->getId () );

?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css">

<table id="tableau" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Pr&eacute;nom</th>
			<th>Pseudo</th>
			<th>D&eacute;tails</th>
		</tr>
	</thead>
	<tbody>
           		<?php
			while ( $row = mysql_fetch_array ( $reqRecherche ) ) 
			{
				?>
            <tr>
			<td class="autre_colonne">
                    <?php echo $row['nom_etu']; ?>
                </td>
			<td class="autre_colonne">
                    <?php echo $row['prenom_etu']; ?>
                </td>
			<td class="autre_colonne">
                    <?php echo $row['pseudo_etu']; ?>
                </td>
			<td class="autre_colonne"><a
				href="index.php?section=etudiant&e=<?php echo $row['id_etu']; ?>"><i class="glyphicon glyphicon-list-alt" title="Cliquez pour plus de d&eacute;tails sur cette personne"></i></a></td>
		</tr>
                <?php
			}
				?>
        </tbody>
</table>

