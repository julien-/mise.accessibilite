<?php 
$daoSujet = new DAOSujet($db);
$daoCours =new DAOCours($db);
$daoNews = new DAONews($db);

if (isset($_GET['c']))
{
	$liste5DerniersSujets = $daoSujet->getLastFiveByCours($_GET['c']);
	$cours = $daoCours->getByID($_GET['c']);
	$listeThemes = $daoTheme->getAllByCours($_GET['c']);
	$listeNews = $daoNews->getLastNews(10, $_GET['c']);
	
	$titre = $cours->getLibelle();
	$urlJSONPieChart = '../../chart/cours_global_pie_chart.php?&c=' . $cours->getId();
	
	include_once('../vue/details_cours.php');
}
?>