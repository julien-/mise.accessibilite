<?php
include_once('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();
$daoProfesseur = new DAOProfesseur($db);
$daoCours = new DAOCours($db);
$daoTheme = new DAOTheme($db);
$daoExo = new DAOExercice($db);
$daoInscription = new DAOInscription($db);
$daoSeance = new DAOSeance($db);
$daoAvancement = new DAOAvancement($db);
$daoEtudiant = new DAOEtudiant($db);
$listeInscriptions = $daoInscription->getAllByCours(1);
$listeCours = $daoCours->getAllByProf(17);
$daoSeance = new DAOSeance($db);
$daoAvancement = new DAOAvancement($db);
$daoCategorie = new DAOCategorie($db);
$daoSujet = new DAOSujet($db);
$daoMessage = new DAOMessage($db);

if (isset($_SESSION['currentUser']))
{
	$nbMessagesNnLu = $daoMessage->countNbNonLu($_SESSION['currentUser']->getId());
	
	if (isset($_GET['c']))
		$_SESSION['cours'] = $daoCours->getByID($_GET['c']);
	$daoCours = new DAOCours($db);
	$listeCours = $daoCours->getAllByProf($_SESSION['currentUser']->getId());
	if (isset($_GET['section'])) 
	{
		$page = $_GET['section'];
		$pageWithoutPath = $page;
		if (strpos($page, 'forum') != false)
		{
			$page = '../../forum/controleur/' . $page;
		}
		
		if (strpos($page, 'messagerie') != false)
		{
			$page = '../../messagerie/controleur/' . $page;
		}
		
		if($page == "compte" )
		{
			$page = '../../compte/Controleur/' . $page;
		}
	} else 
	{
		$page = 'cours';
		$pageWithoutPath = $page;
	}
}
else if (isset($_GET['section'])) 
{
	$page = $_GET['section'];
	$pageWithoutPath = $page;
}
else
{
	?>
	<script>
	document.location.replace("../../index.php");
	</script>
	<?php 
}

$filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'final'); 
switch($pageWithoutPath)
{
	case 'cours' : 

			$filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'final'); 

		break;
	case 'compte': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=accueil', 'Mon Compte' => 'final'); break;
	case 'details_theme': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?', $daoTheme->getByID($_GET['t'])->getCours()->getLibelle() => 'index.php?section=details_cours&c='.$daoTheme->getByID($_GET['t'])->getCours()->getId(), $daoTheme->getByID($_GET['t'])->getTitre() => 'final'); break;
	case 'gestion_cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?', 'Gestion du cours' => 'final'); break;
	case 'envoyes_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?', 'Messagerie' => 'index.php?section=reception_messagerie', 'Boite d\'envoi' => 'final'); break;
	case 'voir_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Messagerie' => 'index.php?section=reception_messagerie', 'Lecture d\'un message' => 'final'); break;
	case 'envoyer_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Messagerie' => 'index.php?section=reception_messagerie', 'Envoyer un message' => 'final'); break;
	case 'reception_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Messagerie' => 'final'); break;
	case 'mes_etudiants': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'final'); break;
	case 'mes_cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes cours' => 'final'); break;
	case 'seance': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes s&eacute;ances' => 'final'); break;
	case 'details_cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes cours' => 'index.php?section=mes_cours', $daoCours->getByID($_SESSION['cours']->getId())->getLibelle() => 'final'); break;
	case 'etudiant': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'index.php?section=mes_etudiants', $daoEtudiant->getByID($_GET['e'])->getPrenom() . ' ' . $daoEtudiant->getByID($_GET['e'])->getNom()  => 'final'); break;
	case 'details_cours_etudiant': 
		if (!isset($_GET['e']))
		{
			$page = 'erreur';
		}
		else
		{
			$filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'index.php?section=mes_etudiants', $daoEtudiant->getByID($_GET['e'])->getPrenom() . ' ' . $daoEtudiant->getByID($_GET['e'])->getNom() => 'index.php?section=etudiant&e='.$_GET['e'], 'Statistiques' => 'final'); 
		}
		break;
	case 'details_theme_etudiant': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'index.php?section=mes_etudiants', $daoEtudiant->getByID($_GET['e'])->getPrenom() . ' ' . $daoEtudiant->getByID($_GET['e'])->getNom() => 'index.php?section=etudiant&e='.$_GET['e'], $daoTheme->getByID($_GET['t'])->getTitre() => 'final'); break;
	case 'index_forum': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes cours' => 'index.php?section=mes_cours',  $daoCours->getByID($_GET['id_cours'])->getLibelle() => 'index.php?section=details_cours&c='.$_GET['id_cours'], 'Index du forum' => 'final'); break;
	case 'liste_sujets_forum': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes cours' => 'index.php?section=mes_cours',  $daoCategorie->getByID($_GET['categorie'])->getCours()->getLibelle() => 'index.php?section=details_cours&c='.$daoCategorie->getByID($_GET['categorie'])->getCours()->getId(), 'Index du forum' => 'index.php?section=index_forum&id_cours='.$daoCategorie->getByID($_GET['categorie'])->getCours()->getId(), Outils::raccourcirChaine($daoCategorie->getByID($_GET['categorie'])->getTitre(), 50) => 'final'); break;
	case 'voir_sujet_forum': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes cours' => 'index.php?section=mes_cours',  $daoSujet->getByID($_GET['s'])->getCategorie()->getCours()->getLibelle() => 'index.php?section=details_cours&c='.$daoSujet->getByID($_GET['s'])->getCategorie()->getCours()->getId(), 'Index du forum' => 'index.php?section=index_forum&id_cours='.$daoSujet->getByID($_GET['s'])->getCategorie()->getCours()->getId(), Outils::raccourcirChaine($daoSujet->getByID($_GET['s'])->getCategorie()->getTitre(), 50) => 'index.php?section=liste_sujets_forum&categorie=' . $daoSujet->getByID($_GET['s'])->getCategorie()->getId(), $daoSujet->getByID($_GET['s'])->getTitre() => 'final'); break;	
}
include_once ('../vue/index.php');