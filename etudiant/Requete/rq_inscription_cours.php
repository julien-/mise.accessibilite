<?php
include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoInscription= new DAOInscription($db);

$redirige = false;

if (isset($_GET["inscriptioncours"])) {
	$now = date("Y-m-d");
	$daoInscription->insertByDateAndEtuAndCours($now, $_SESSION['currentUser']->getId(), $_POST['id_cours']);
	 
	$message = "Inscription réalisée avec succès";
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
	$_SESSION["notif_msg"] = '<div class="erreur">Erreur, requete invalide/div>';

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ../Controleur/index.php?' . $retourPage);
?>