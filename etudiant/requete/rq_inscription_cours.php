<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoInscription= new DAOInscription($db);

if (isset($_GET["inscriptioncours"])) {
	$now = date("Y-m-d");
	$daoInscription->insertByDateAndEtuAndCours($now, $_SESSION['currentUser']->getId(), $_POST['id_cours']);
	$_SESSION['inscriptionAdded'] = 'true';
}


// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>