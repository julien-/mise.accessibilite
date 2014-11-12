<?php
include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoRemarque= new DAORemarque($db);
$daoAvancement= new DAOAvancement($db);

$redirige = false;

if (isset($_GET["addremarque"])) {
	$daoRemarque->saveByIdSeanceIdEtudiantRemarque($_POST['id_seance'], $_SESSION['currentUser']->getId(), $_POST['remarque']);
	$message = "Remarque ajoutée avec succes";
	$redirige = true;
}

if (isset($_GET["modifyremarque"])) {
	$daoRemarque->updateRemarqueByIdSeanceIdEtudiant($_POST['id_seance'], $_SESSION['currentUser']->getId(), $_POST['remarque']);
	$message = "Remarque modifiée avec succes";
	$redirige = true;
}

if (isset($_GET["maj_avancement"])) {
	if(isset($_POST['fait']))
	{		
		foreach($_POST['fait'] as $id_exo)
		{
			$daoAvancement->insertFaitByExerciceEtudiantSeance($id_exo, $_SESSION['currentUser']->getId(), $_POST['id_seance']);
		}
	}
	
	if(isset($_POST['compris']))
	{
		foreach($_POST['compris'] as $id_exo)
		{
			$daoAvancement->insertComprisByExerciceEtudiantSeance($id_exo, $_SESSION['currentUser']->getId(), $_POST['id_seance']);
		}
	}
	
	if(isset($_POST['assimile']))
	{
		foreach($_POST['assimile'] as $id_exo)
		{
			$daoAvancement->insertAssimileByExerciceEtudiantSeance($id_exo, $_SESSION['currentUser']->getId(), $_POST['id_seance']);
		}
	}
	
	$message = "Mise à jour effectuée";
	$redirige = true;
}


/* #################
 * ## REDIRECTION ##
 * #################
 */
mysql_close($db);

// on regarde de quel page il venait
if (isset($_GET['section']))
	$retourPage = "section=". $_GET['section'] ."&id_seance=". $_POST['id_seance'];
else
	$retourPage = "";
session_start();

if ($redirige)
	$_SESSION["notif_msg"] = '<div class="ok">'.$message.'</div>';
else
	$_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête...</div>';

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ../controleur/index.php?' . $retourPage);
?>