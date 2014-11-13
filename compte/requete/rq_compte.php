<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoEtudiant= new DAOEtudiant($db);

$redirige = false;

if (isset($_GET["modifycompte"])) {
	$id_etu = $_SESSION['currentUser']->getId();
	$daoEtudiant->updateNomPrenomMailLoginByEtudiant($_POST['nom_minuscules'], $_POST['prenom'], $_POST['email'], $_POST['pseudo'], $id_etu);
	 
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

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>