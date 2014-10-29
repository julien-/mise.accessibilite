<?php
if(isset($_GET["id_seance"]) && !empty($_GET["id_seance"]))
{
	$remarque = $daoRemarque->getByEtuSeance($_SESSION["currentUser"]->getId(), $_GET["id_seance"]);
	$listeThemes = $daoTheme->getAllByCours($_SESSION["cours"]->getId());
	$urlJSONPieChart = '../../chart/cours_global_pie_chart.php?e=' . $_SESSION["currentUser"]->getId() . '&c=' . $_SESSION["cours"]->getId() . '&s=' . $_GET["id_seance"];
	$id_seance = $_GET["id_seance"];
	include_once('../Vue/seance_actuelle.php');
}
else 
	include_once('../Vue/introuvable.php');
?>