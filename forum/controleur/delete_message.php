<?php 
include_once ('../../lib/autoload.inc.php');
session_start();

DBFactory::getMysqlConnexionStandard();
if (isset($_GET['m']) && $_SESSION['currentUser']->getAdmin())
{
	$id = $_GET['m'];
	$daoMessage = new DAOMessage($db);
	$message = $daoMessage->getByID($id);

	$daoMessage->delete($id);
	
	if ($daoMessage->countBySujet($message->getSujet()->getId()) == 0)
	{
		$daoSujet = new DAOSujet($db);
		$daoSujet->delete($message->getSujet()->getId());
		header('Location: ' . '../../admin/controleur/index.php?section=liste_sujets_forum&categorie='.$message->getSujet()->getCategorie()->getId());
	}
	else
	{
		header('Location: ' . $_SESSION['referrer']);
	}
}


?>