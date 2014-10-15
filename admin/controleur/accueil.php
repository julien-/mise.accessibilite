<?php 
$daoSujet = new DAOSujet($db);
$daoCours =new DAOCours($db);

if (isset($_GET['c']))
{
	$liste5DerniersSujets = $daoSujet->getLastFiveByCours($_GET['c']);
	$cours = $daoCours->getByID($_GET['c']);

	include_once('../vue/accueil.php');
}
?>