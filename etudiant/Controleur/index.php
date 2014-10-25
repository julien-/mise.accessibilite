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
$nbMessagesNnLu = $daoMessage->countNbNonLu($_SESSION['currentUser']->getId());

if (isset($_GET['section']) && !empty($_GET['section'])) 
{
	$now = date("Y-m-d");   //recupère la date d'aujourd'hui
	
	$page = $_GET['section'];
	$pageWithoutPath = $page;
	
	if (strpos($page, 'messagerie') != false)
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
		
		$page = '../../messagerie/controleur/' . $page;
		unset($_SESSION['cours']);
	}
	elseif($page == "accueil" || $page == "cours" || $page == "compte")
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
{
	$page = "accueil";
	$pageWithoutPath = $page;
}

//affichage des notifications
if (isset($_SESSION["notif_msg"]) && !(empty($_SESSION["notif_msg"]))) {
	echo ($_SESSION["notif_msg"]);
	$_SESSION["notif_msg"] = "";
}
switch($pageWithoutPath)
{
	case 'accueil': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Accueil' => 'final'); break;
	case 'envoyer_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Messagerie' => 'index.php?section=reception_messagerie', 'Envoyer un message' => 'final'); break;
	case 'voir_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Messagerie' => 'index.php?section=reception_messagerie','Boite de réception' => 'index.php?section=reception_messagerie', 'Message reçu' => 'final'); break;
	case 'envoyes_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Messagerie' => 'index.php?section=reception_messagerie', 'Boite d\'envoi' => 'final'); break;
	case 'reception_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Messagerie' => 'index.php?section=reception_messagerie', 'Boîte de réception' => 'final'); break;
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