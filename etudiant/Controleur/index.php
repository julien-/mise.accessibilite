<?php

include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoCours = new DAOCours($db);
$daoInscription = new DAOInscription($db);
$daoSeance = new DAOSeance($db);
$daoAvancement = new DAOAvancement($db);
$daoRemarque = new DAORemarque($db);
$daoTheme = new DAOTheme($db);
$daoBonus= new DAOBonus($db);
$daoAvancement_bonus= new DAOAvancement_bonus($db);


$listeCours = $daoInscription->getAllByEtudiant($_SESSION["currentUser"]->getId());

if (isset($_GET['section']) && !empty($_GET["section"])) 
{
	$page = $_GET['section'];
	if($page == "cours")
		unset($_SESSION["cours"]);
	else 
	{
		$now = date("Y-m-d");   //recupère la date d'aujourd'hui
		
		if(isset($_GET["id_cours"]) && !empty($_GET["id_cours"]))
			$listeSeances = $daoSeance->getAllByCours($_GET["id_cours"]); 
		elseif(isset($_SESSION["cours"]) && !empty($_SESSION["cours"]))
			$listeSeances = $daoSeance->getAllByCours($_SESSION["cours"]->getId());
		
	}		
} 
else {
	$page = 'cours';
}

include_once('../Vue/index.php');

?>