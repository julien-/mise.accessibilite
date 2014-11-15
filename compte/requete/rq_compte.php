<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoEtudiant= new DAOEtudiant($db);


if (isset($_GET["modifycompte"])) {
	$id_etu = $_SESSION['currentUser']->getId();
	$daoEtudiant->updateNomPrenomMailLoginByEtudiant($_POST['nom_minuscules'], $_POST['prenom'], $_POST['email'], $_POST['pseudo'], $id_etu);
	 
	$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
	$_SESSION['compteModified'] = 'true';
}

if (isset($_GET["modifypassword"])) {
	$id_etu = $_SESSION['currentUser']->getId();
	$daoEtudiant->updatePasswordByEtudiant($_POST['nouveau_pwd'], $id_etu);
	
	$_SESSION['currentUser'] = $daoEtudiant->getByID($id_etu);
	$_SESSION['passwordModified'] = 'true';
}

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>