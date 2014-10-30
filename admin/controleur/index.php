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
	} else 
	{
		$page = 'mes_cours';
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

switch($pageWithoutPath)
{
	case 'details_theme': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=details_cours', $daoTheme->getByID($_GET['t'])->getCours()->getLibelle() => 'index.php?section=details_cours&c='.$daoTheme->getByID($_GET['t'])->getCours()->getId(), $daoTheme->getByID($_GET['t'])->getTitre() => 'final'); break;
	case 'gestion_cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=details_cours', 'Gestion du cours' => 'final'); break;
	case 'envoyes_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php?section=details_cours', 'Messagerie' => 'index.php?section=reception_messagerie', 'Boite d\'envoi' => 'final'); break;
	case 'voir_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Messagerie' => 'index.php?section=reception_messagerie', 'Lecture d\'un message' => 'final'); break;
	case 'envoyer_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Messagerie' => 'index.php?section=reception_messagerie', 'Envoyer un message' => 'final'); break;
	case 'reception_messagerie': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Messagerie' => 'final'); break;
	case 'mes_etudiants': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'final'); break;
	case 'mes_cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes cours' => 'final'); break;
	case 'seance': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes s&eacute;ances' => 'final'); break;
	case 'details_cours': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes cours' => 'index.php?section=mes_cours', $daoCours->getByID($_GET['c'])->getLibelle() => 'final'); break;
	case 'etudiant': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'index.php?section=mes_etudiants', $daoEtudiant->getByID($_GET['e'])->getPrenom() . ' ' . $daoEtudiant->getByID($_GET['e'])->getNom()  => 'final'); break;
	case 'details_cours_etudiant': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'index.php?section=mes_etudiants', $daoEtudiant->getByID($_GET['e'])->getPrenom() . ' ' . $daoEtudiant->getByID($_GET['e'])->getNom() => 'index.php?section=etudiant&e='.$_GET['e'], $daoCours->getByID($_GET['c'])->getLibelle() => 'final'); break;
	case 'details_theme_etudiant': $filArianne = array('<i class="glyphicon glyphicon-home"></i>' => 'index.php', 'Mes étudiants' => 'index.php?section=mes_etudiants', $daoEtudiant->getByID($_GET['e'])->getPrenom() . ' ' . $daoEtudiant->getByID($_GET['e'])->getNom() => 'index.php?section=etudiant&e='.$_GET['e'], $daoCours->getByID($daoTheme->getByID($_GET['t'])->getCours()->getId())->getLibelle() => 'index.php?section=details_cours_etudiant&c='.$daoTheme->getByID($_GET['t'])->getCours()->getId().'&e='.$_GET['e'], $daoTheme->getByID($_GET['t'])->getTitre() => 'final'); break;
	
}
include_once ('../vue/index.php');