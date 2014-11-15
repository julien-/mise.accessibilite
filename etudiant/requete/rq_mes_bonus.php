<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoAvancement_bonus= new DAOAvancement_bonus($db);
$daoBonus= new DAOBonus($db);

if (isset($_GET["addbonus"])) {
	$daoBonus->insertByTitreTypeTheme($_POST['titrebonus'], $_POST['typebonus'], $_POST['themebonus']);
	$id_bonus = $daoBonus->getLastInsertBonus();
	$daoAvancement_bonus->insertFaitByEtuBonus($_SESSION['currentUser']->getId(), $id_bonus);
	if(isset($_POST['Etudiant']))
	{
		foreach($_POST['Etudiant'] as $id_etu)
		{
			$daoAvancement_bonus->insertFaitByEtuBonus($id_etu, $id_bonus);
		}
	}
	$_SESSION['bonusAdded'] = 'true';
}


// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>