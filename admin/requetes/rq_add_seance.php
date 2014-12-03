<?php 
include_once('../../lib/autoload.inc.php');
session_start();
$db = DBFactory::getMysqlConnexionStandard();
$daoSeance = new DAOSeance($db);

if (isset($_POST['date']))
{
	$seance = new Seance();
	$seance->setCours($_SESSION['cours']->getId());
	$seance->setDate(Outils::dateToUS($_POST['date']));
	$daoSeance->save($seance);
}
header('Location: ' . $_SESSION['referrer'] . '&added=added');
?>