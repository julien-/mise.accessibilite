<?php

session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');
include_once ('../../lib/autoload.inc.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoEtudiant = new DAOEtudiant($db);
$daoCours = new DAOCours($db);

$etudiant = $daoEtudiant->getByID(65);
$_SESSION["currentUser"] = $etudiant;

$listeCours = $daoCours->getAllByEtu($etudiant);

if (isset($_GET['section'])) {
	$page = $_GET['section'];
} else {
	$page = 'evolution';
}

include_once('../Vue/index.php');

?>