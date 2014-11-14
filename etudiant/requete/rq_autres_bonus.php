<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoAvancement_bonus= new DAOAvancement_bonus($db);

if (isset($_GET["addremarque"])) {
	$daoAvancement_bonus->updateRemarqueByEtuBonus($_SESSION['currentUser']->getId(), $_POST['id_bonus'], $_POST['remarque']);
	$_SESSION['remarqueAdded'] = 'true';
}

if (isset($_GET["addnote"])) {
	$daoAvancement_bonus->updateNoteByEtuBonus($_SESSION['currentUser']->getId(), $_POST['id_bonus'], $_POST['note']);
	$_SESSION['noteAdded'] = 'true';
}

if (isset($_GET["addsuivi"])) {
	$daoAvancement_bonus->insertSuiviByEtuBonus($_SESSION['currentUser']->getId(), $_POST['id_bonus']);
	$_SESSION['suiviAdded'] = 'true';
}

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>