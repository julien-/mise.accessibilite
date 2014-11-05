<?php 
include_once('../../lib/autoload.inc.php');
session_start();
DBFactory::getMysqlConnexionStandard();

$daoSeance = new DAOSeance($db);

if (isset($_POST['submit']))
{
	$daoSeance->save(new Seance(array(
			'date' => $_POST['date'],
			'cours' => $_SESSION['cours']->getId()
	)));
}

header('Location: ' . $_SESSION['referrer']);
?>