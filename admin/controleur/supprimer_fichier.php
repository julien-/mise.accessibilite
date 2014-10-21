<?php 
include_once ("../../lib/autoload.inc.php");
session_start();

$db = DBFactory::getMysqlConnexionStandard();
$daoFichiers = new DAOFichier($db);

if (isset($_GET["f"])) 
{
	$fichier = $daoFichiers->getByID($_GET["f"]);
	$daoFichiers->delete($fichier->getId());
	$success = $fichier->deleteFromServer('../../');
}

if ($success)
	$_SESSION["notif_msg"] = '<div class="ok">Fichier supprimé</div>';
else
	$_SESSION["notif_msg"] = '<div class="erreur">Erreur dans l\' execution de la requête.' . $msgperso . '</div>';

header('Location: ' . $_SESSION['referrer']);
?>