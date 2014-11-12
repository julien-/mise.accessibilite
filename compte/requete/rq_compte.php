<?php
include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoEtudiant= new DAOEtudiant($db);

$redirige = false;

if (isset($_GET["modifycompte"])) {
	$id_etu = $_SESSION['currentUser']->getId();
	$daoEtudiant->updateNomPrenomMailLoginByEtudiant($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['pseudo'], $id_etu);
	 
	$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
	$message = "Compte modifié avec succes";
	$redirige = true;
}

if (isset($_GET["modifypassword"])) {
	$id_etu = $_SESSION['currentUser']->getId();
	$daoEtudiant->updatePasswordByEtudiant($_POST['nouveau_pwd'], $id_etu);
	
	$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
	$message = "Password modifié avec succes";
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
header('Location: ' . $_SESSION['referrer']);
?>