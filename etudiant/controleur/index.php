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
$daoCategorie = new DAOCategorie($db);
$daoSujet = new DAOSujet($db);
$daoObjectif = new DAOObjectif($db);
$daoAssignations_objectif = new DAOAssignations_objectif($db);

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
	elseif(strpos($page, 'forum') != false)
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
		
		/* Check objectifs */
		$daoAssignations_objectif = new DAOAssignations_objectif($db);
		$listeAssignationsObjectifs = $daoAssignations_objectif->checkAllByEtudiantCours($_SESSION['currentUser']->getId(), $_SESSION['cours']->getId());
		
		
		$page = '../../forum/controleur/' . $page;
	}
	elseif($page == "compte" )
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
		
		$page = '../../compte/Controleur/' . $page;
	}
	elseif($page == "accueil" || $page == "cours" || $page == "inscription_cours")
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
		
		/* Check objectifs */
		$daoAssignations_objectif = new DAOAssignations_objectif($db);
		$listeAssignationsObjectifs = $daoAssignations_objectif->checkAllByEtudiantCours($_SESSION['currentUser']->getId(), $_SESSION['cours']->getId());
		
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
	case 'inscription_cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'S\'inscrire' => 'final'); break;
	case 'informations': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Informations' => 'final'); break;
	case 'objectif': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Mes Badges' => 'final'); break;
	case 'evolution': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Mon Evolution' => 'final'); break;
	case 'progression': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Ma Progression' => 'final'); break;
	case 'details_theme_etudiant': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Ma Progression' => 'index.php?section=progression', $daoTheme->getByID($_GET['id_theme'])->getTitre() => 'final'); break;
	case 'seance_precedente': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index?section=accueil.php', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Séance du '.transformerDate($daoSeance->getByID($_GET["id_seance"])->getDate()) => 'final'); break;
	case 'seance_actuelle': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Séance du '.transformerDate($daoSeance->getByID($_GET["id_seance"])->getDate()) => 'final'); break;
	case 'mes_bonus': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Mes Bonus' => 'final'); break;
	case 'autres_bonus': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Autres Bonus' => 'final'); break;
	case 'index_forum': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours',  $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Index du forum' => 'final'); break;
	case 'liste_sujets_forum': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours',  $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Index du forum' => 'index.php?section=index_forum&id_cours='.$_SESSION['cours']->getId(), Outils::raccourcirChaine($daoCategorie->getByID($_GET['categorie'])->getTitre(), 50) => 'final'); break;
	case 'voir_sujet_forum': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mes Cours' => 'index.php?section=cours',  $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'index.php?section=evolution', 'Index du forum' => 'index.php?section=index_forum&id_cours='.$_SESSION['cours']->getId(), Outils::raccourcirChaine($daoSujet->getByID($_GET['s'])->getCategorie()->getTitre(), 50) => 'index.php?section=liste_sujets_forum&categorie=' . $daoSujet->getByID($_GET['s'])->getCategorie()->getId(), $daoSujet->getByID($_GET['s'])->getTitre() => 'final'); break;
}
include_once('../vue/index.php');

?>