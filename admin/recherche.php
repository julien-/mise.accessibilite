<?php
if (isset ( $_GET ['section'] ) && $_GET ['section'] == 'recherche') {
	$titre = "<h1 class=\"titre_page_school\">Mes &eacute;tudiants</h1>";
	$pRetour = "index.php?section=recherche";
} else {
	$titre = "<h2 class=\"titre_scolaire\">Recherche d'&eacute;tudiant</h2>";
	$pRetour = "index.php?r=1";
}
echo $titre;

$daoInscription = new DAOInscription($db);
$listeResultats = $daoInscription->getAllByProfesseur($_SESSION ['currentUser']->getId());
//$reqRecherche = SQLQuery ( 'SELECT * FROM etudiant e, inscription i, cours c WHERE e.id_etu = i.id_etu AND c.id_cours = i.id_cours AND c.id_prof = ' . $_SESSION ['currentUser']->getId () );

?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css">

<table id="tableau" class="table table-striped table-bordered">
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
                    <?php echo utf8_encode($resultat->getEtudiant()->getNom()); ?>
                </td>
			<td class="autre_colonne">
                    <?php echo utf8_encode($resultat->getEtudiant()->getPrenom()); ?>
                </td>
			<td class="autre_colonne">
                    <?php echo utf8_encode($resultat->getEtudiant()->getLogin()); ?>
                </td>
			<td class="autre_colonne"><a
				href="index.php?section=etudiant&e=<?php echo $resultat->getEtudiant()->getId(); ?>"><i class="glyphicon glyphicon-list-alt" title="Cliquez pour plus de d&eacute;tails sur cette personne"></i></a></td>
		</tr>
                <?php
			}
				?>
        </tbody>
</table>

