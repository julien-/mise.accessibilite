<?php 
$daoSujet = new DAOSujet($db);
$daoCours =new DAOCours($db);
$daoNews = new DAONews($db);
$_SESSION ['referrer'] = Outils::currentPageURL();
if (isset($_SESSION['cours']))
{
	if (isset($_GET['deleted']))
	{
		$alertDeleted = new AlerteSuccess('Bonus supprimé');
		$alertDeleted->show();
	}
	$liste5DerniersSujets = $daoSujet->getLastFiveByCours($_SESSION['cours']->getId());
	$cours = $daoCours->getByID($_SESSION['cours']->getId());
	$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());
	$listeNews = $daoNews->getLastNews(10, $_SESSION['cours']->getId());
	
	$titre = $cours->getLibelle();
	$urlJSONPieChart = '../../chart/cours_global_pie_chart.php?&c=' . $cours->getId();
	$daoAvancementBonus = new DAOAvancement_bonus($db);
	
	include_once('../vue/details_cours.php');
}


?>