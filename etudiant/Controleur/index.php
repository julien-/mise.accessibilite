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
$daoMessage = new DAOMessage($db);

$listeCours = $daoInscription->getAllByEtudiant($_SESSION['currentUser']->getId());

if (isset($_GET['section']) && !empty($_GET['section'])) 
{
	$now = date("Y-m-d");   //recupère la date d'aujourd'hui
	
	$page = $_GET['section'];
	
	if($page == "accueil" || $page == "cours" || $page == "compte" || $page == "messagerie")
	{
		//historique
		$historique = new Historique(array(
				'page' => $page,
				'dateVisite' => $now,
				'heureVisite' => date("H:i:s"),
				'etudiant' => $_SESSION['currentUser'],
				'cours' => '0'
		));
		$daoHistorique->save($historique);
		
		unset($_SESSION['cours']);
	}
	else 
	{		
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
	$page = "accueil";

//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
	echo ($_SESSION["notif_msg"]);
	$_SESSION["notif_msg"] = "";
}
switch($page)
{
	case 'accueil': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Accueil' => 'final'); break;
	case 'compte': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mon Compte' => 'final'); break;
	case 'messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Ma Messagerie' => 'final'); break;
	case 'cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'final'); break;
	case 'evolution': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Evolution' => 'final'); break;
	case 'seance_precedente': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index?section=accueil.php', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Séance du '.transformerDate($daoSeance->getByID($_GET["id_seance"])->getDate()) => 'final'); break;
	case 'seance_actuelle': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Séance du '.transformerDate($daoSeance->getByID($_GET["id_seance"])->getDate()) => 'final'); break;
	case 'mes_bonus': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Mes Bonus' => 'final'); break;
	case 'autres_bonus': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Autres Bonus' => 'final'); break;
}
include_once('../Vue/index.php');

?>