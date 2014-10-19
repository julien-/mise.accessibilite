<?php 

include_once('../../lib/autoload.inc.php');
$db = DBFactory::getMysqlConnexionStandard();
session_start();
if (isset($_SESSION['currentUser']) && $_SESSION['currentUser']->getAdmin() == 1)
{
	if (isset($_GET['theme']))
	{
		$daoTheme = new DAOTheme($db);
		$daoTheme->delete($_GET['theme']);
	}
	
	if (isset($_GET['exercice']))
	{
		$daoExercice = new DAOExercice($db);
		$daoExercice->delete($_GET['exercice']);
	}
	
	if (isset($_GET['cours']))
	{
		$daoCours = new DAOCours($db);
		$daoCours->delete($_GET['cours']);
	}
	
	if (isset($_GET['seance']))
	{
		$daoSeance = new DAOSeance($db);
		$daoSeance->delete($_GET['seance']);
	}
}
header('Location: ' . $_SESSION['referrer']);
?>