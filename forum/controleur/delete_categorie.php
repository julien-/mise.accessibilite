<?php 
include_once ('../../lib/autoload.inc.php');
session_start();

DBFactory::getMysqlConnexionStandard();
if (isset($_GET['c']) && $_SESSION['currentUser']->getAdmin())
{
	$id = $_GET['c'];
	$daoCategorie = new DAOCategorie($db);
	$daoCategorie->delete($id);

	header('Location: ' . $_SESSION['referrer']);
}
?>