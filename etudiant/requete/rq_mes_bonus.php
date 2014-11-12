<?php
include_once ('../../lib/autoload.inc.php');
session_start();
include_once('../../sql/connexion_mysql.php');
include_once('../../fonctions.php');

$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoAvancement_bonus= new DAOAvancement_bonus($db);
$daoBonus= new DAOBonus($db);

$redirige = false;

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
	$redirige = true;
}

/* #################
 * ## REDIRECTION ##
 * #################
 */
mysql_close($db);

// on regarde de quel page il venait
if (isset($_GET['section']))
	$retourPage = "section=". $_GET['section'];
else
	$retourPage = "";
session_start();

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ../controleur/index.php?' . $retourPage);
?>