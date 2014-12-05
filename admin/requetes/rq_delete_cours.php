<?php 
include_once('../../lib/autoload.inc.php');
session_start();
$db = DBFactory::getMysqlConnexionStandard();
$daoCours = new DAOCours($db);

if (isset($_POST['id-cours']))
	$daoCours->delete($_SESSION['cours']->getId());

header('Location: index.php?deleted=deleted');
?>