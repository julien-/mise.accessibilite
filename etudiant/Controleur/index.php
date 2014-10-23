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
$daoEtudiant= new DAOEtudiant($db);
$daoAvancement_bonus= new DAOAvancement_bonus($db);
$daoHistorique = new DAOHistorique($db);

$listeCours = $daoInscription->getAllByEtudiant($_SESSION['currentUser']->getId());

if (isset($_GET['section']) && !empty($_GET['section'])) 
{
	$page = $_GET['section'];
	if($page == "cours")
		unset($_SESSION['cours']);
	else 
	{
		$now = date("Y-m-d");   //recupère la date d'aujourd'hui
		
		if(isset($_GET['id_cours']) && !empty($_GET['id_cours']))
		{
			$_SESSION['cours'] = $daoCours->getByID($_GET['id_cours']);
		}
		
		$listeSeances = $daoSeance->getAllByCours($_SESSION["cours"]->getId());
		$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());
		$listeInscritsExeptCurrentUser = $daoInscription->getAllByCoursExceptEtu($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());
				
		//historique
		$historique = new Historique(array(
				'page' => $page,
				'dateVisite' => $now,
				'heureVisite' => date("H:i:s"),
				'etudiant' => $_SESSION['currentUser'],
				'cours' => $_SESSION['cours']->getId()
		));
		$daoHistorique->save($historique);
	}		
} 
else
	$page = "cours";

//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
	echo ($_SESSION["notif_msg"]);
	$_SESSION["notif_msg"] = "";
}

include_once('../Vue/index.php');

?>