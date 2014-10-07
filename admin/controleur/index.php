<?php
session_start();
include_once('../../lib/autoload.inc.php');
include_once('../../fonctions.php');
include_once "../../sql/connexion_mysql.php";
include_once "../../config.php";
$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoProfesseur = new DAOProfesseur($db);
$daoCours = new DAOCours($db);
$daoTheme = new DAOTheme($db);
$daoExo = new DAOExercice($db);

$professeur = $daoProfesseur->getByID($_SESSION['id']);

$listeCours = $daoCours->getAllByProf($professeur);

$theme = $daoTheme->getByID(7);
echo $theme->getTitre();

$exercice = $daoExo->getByID(16);

echo $exercice->getTheme()->getCours()->getLibelle();

$_SESSION['currentUser'] = $professeur; 
if (isset($_GET['section'])) {
	$page = $_GET['section'];
} else {
	$page = 'mes_cours';
}
include_once ('../vue/index.php');