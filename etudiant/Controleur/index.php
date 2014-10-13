<?php

include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoEtudiant = new DAOEtudiant($db);
$daoCours = new DAOCours($db);
$daoInscription = new DAOInscription($db);

$etudiant = $daoEtudiant->getByID(65);
$_SESSION["currentUser"] = $etudiant;

$listeCours = $daoInscription->getAllByEtudiant($etudiant->getId());

if (isset($_GET['section'])) 
{
	$page = $_GET['section'];
	if($page == "cours")
		unset($_SESSION["cours"]);		
} 
else {
	$page = 'cours';
}

include_once('../Vue/index.php');

?>