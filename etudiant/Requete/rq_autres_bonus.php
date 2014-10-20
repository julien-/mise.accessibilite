<?php
include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoAvancement_bonus= new DAOAvancement_bonus($db);

$redirige = false;

if (isset($_GET["addremarque"])) {
	$daoAvancement_bonus->updateRemarqueByEtuBonus($_SESSION['currentUser']->getId(), $_POST['id_bonus'], $_POST['remarque']);
	$message = "Remarque ajoutée avec succes";
	$redirige = true;
}

if (isset($_GET["addnote"])) {
	$daoAvancement_bonus->updateNoteByEtuBonus($_SESSION['currentUser']->getId(), $_POST['id_bonus'], $_POST['note']);
	$message = "Note ajoutée avec succes";
	$redirige = true;
}

if (isset($_GET["addsuivi"])) {
	$daoAvancement_bonus->insertSuiviByEtuBonus($_SESSION['currentUser']->getId(), $_POST['id_bonus']);
	$message = "Requete effectuée avec succes";
	$redirige = true;
}

/* #################
 * ## REDIRECTION ##
 * #################
 */
mysql_close($db);

// on regarde de quel page il venait
if (isset($_GET['section']))
	$retourPage = "section=". $_GET['section'];
else
	$retourPage = "";
session_start();

if ($redirige)
	$_SESSION["notif_msg"] = '<div class="ok">'.$message.'</div>';
else
	$_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête...</div>';

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ../Controleur/index.php?' . $retourPage);
?>