<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoInscription= new DAOInscription($db);


if (isset($_GET["modifiercouleur"])) {
	$daoInscription->modifierCouleur($_POST['cours'], $_SESSION['currentUser']->getId(), $_POST['couleur_fond'], $_POST['couleur_texte']);
	$_SESSION['themeAdded'] = 'true';
}

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>