<?php 
$daoSujet = new DAOSujet($db);
$daoCours =new DAOCours($db);
$daoNews = new DAONews($db);

if (isset($_GET['c']))
{
	$liste5DerniersSujets = array();
	$cours = $daoCours->getByID($_GET['c']);
	
	$listeNews = array();
	

	include_once('../vue/accueil.php');
}
?>