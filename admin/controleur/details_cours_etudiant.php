<?php 
$daoSujet = new DAOSujet($db);
$daoCours =new DAOCours($db);
$daoNews = new DAONews($db);
$daoEtudiant = new DAOEtudiant($db);
$daoAvancement = new DAOAvancement($db);
$daoTheme = new DAOTheme($db);
$_SESSION ['referrer'] = Outils::currentPageURL();
if (isset($_SESSION['cours']) && isset($_GET['e']))
{
	$liste5DerniersSujets = $daoSujet->getLastFiveByCoursEtudiant($_SESSION['cours']->getId(), $_GET['e']);
	$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());
	
	$cours = $daoCours->getByID($_SESSION['cours']->getId());
	$etudiant = $daoEtudiant->getByID($_GET['e']);
	$listeNews = $daoNews->getLastNewsByCoursEtudiant(10, $_SESSION['cours']->getId(), $_GET['e']);
	
	$titre = $cours->getLibelle();
	$urlJSONPieChart = '../../chart/cours_global_pie_chart.php?e=' . $etudiant->getId() . '&c=' . $cours->getId();
	$daoAvancementBonus = new DAOAvancement_bonus($db);
	include_once('../vue/details_cours_etudiant.php');
}
?>