<?php 
include_once ('../../lib/autoload.inc.php');
session_start();

DBFactory::getMysqlConnexionStandard();
if (isset($_GET['s']) && $_SESSION['currentUser']->getAdmin())
{
	$id = $_GET['s'];
	$daoSujet = new DAOSujet($db);
	
	$daoSujet->delete($id);
}

header('Location: ' . $_SESSION['referrer']);


?>