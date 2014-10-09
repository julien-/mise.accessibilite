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
$daoInscription = new DAOInscription($db);
$daoSeance = new DAOSeance($db);
$daoAvancement = new DAOAvancement($db);

echo $daoProfesseur->getByID(17)->getNom();




foreach ($daoTheme->getAllByCours(1) as $theme)
{
	echo $theme->getTitre();
}
$listeInscriptions = $daoInscription->getAllByCours(1);
$listeCours = $daoCours->getAllByProf(17);


$listeSeance = $daoSeance->getAllByCours(2);

//echo $daoSeance->getByID(1)->getCours()->getLibelle();

$professeur = $daoProfesseur->getByID($_SESSION['id']);

$_SESSION['currentUser'] = $professeur; 
if (isset($_GET['section'])) {
	$page = $_GET['section'];
} else {
	$page = 'mes_cours';
}
include_once ('../vue/index.php');