<?php
$_SESSION['referrer'] = Outils::currentPageURL();
$daoMessage = new DAOMessage($db);
$daoSujet = new DAOSujet($db);

$listeMessages = $daoMessage->getAllBySujet($_GET['s']);
$sujet = $daoSujet->getByID($_GET['s']);

if (!isset($_GET['repondre']))
{
	$listeMessages = $daoMessage->getAllBySujet($_GET['s']);
	include_once('../../forum/vue/voir_sujet_forum.php');
}
else 
{
	$listeMessages = $daoMessage->getLastTenBySujet($_GET['s']);
	include_once('../../forum/vue/repondre_forum.php');
}
	
?>
