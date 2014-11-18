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
	
	if (isset($_GET['cours-delete']))
	{
		$daoCours = new DAOCours($db);
		if (isset($_SESSION['cours']) && $_SESSION['cours']->getId() == $_GET['cours-delete'])
		{
			unset($_SESSION['cours']);
			$_SESSION['referrer'] = 'index.php';
		}
		$daoCours->delete($_GET['cours-delete']);
	}
	
	if (isset($_GET['seance']))
	{
		$daoSeance = new DAOSeance($db);
		$daoSeance->delete($_GET['seance']);
	}
	
	if (isset($_GET['bonus']))
	{
		$daoBonus = new DAOBonus($db);
		$daoBonus->delete($_GET['bonus']);
	}
}
header('Location: ' . $_SESSION['referrer'] . '&deleted=true');
?>