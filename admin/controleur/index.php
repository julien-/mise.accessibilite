<?php
include_once('../../lib/autoload.inc.php');
session_start();

include_once('../../fonctions.php');
include_once "../../sql/connexion_mysql.php";
include_once "../../config.php";
$db = DBFactory::getMysqlConnexionWithMySQLi();
$daoProfesseur = new DAOProfesseur($db);
$daoCours = new DAOCours($db);
$daoTheme = new DAOTheme($db);
$daoExo = new DAOExercice($db);
$daoInscription = new DAOInscription($db);
$daoSeance = new DAOSeance($db);
$daoAvancement = new DAOAvancement($db);
$daoEtudiant = new DAOEtudiant($db);
$listeInscriptions = $daoInscription->getAllByCours(1);
$listeCours = $daoCours->getAllByProf(17);
$daoSeance = new DAOSeance($db);
$daoAvancement = new DAOAvancement($db);
$daoCategorie = new DAOCategorie($db);
$daoSujet = new DAOSujet($db);
$daoMessage = new DAOMessage($db);


if (isset($_SESSION['currentUser']))
{
	if (isset($_GET['section'])) 
	{
		$page = $_GET['section'];
		
		if (strpos($page, 'forum') != false)
		{
			$page = '../../forum/controleur/' . $page;
		}
	} else 
	{
		$page = 'mes_cours';
	}
}
else if (isset($_GET['section'])) 
{
	$page = $_GET['section'];
}
else
{
	?>
	<script language="Javascript">
	document.location.replace("../../index.php");
	</script>
	<?php 
}
include_once ('../vue/index.php');