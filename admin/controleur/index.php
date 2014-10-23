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
switch($page)
{
	case 'mes_cours': $filArianne = array('My Study Companion' => 'index.php', 'Mes cours' => 'final'); break;
	case 'seance': $filArianne = array('My Study Companion' => 'index.php', 'Mes s&eacute;ances' => 'final'); break;
	case 'accueil': $filArianne = array('My Study Companion' => 'index.php', 'Mes cours' => 'index.php?section=mes_cours', $daoCours->getByID($_GET['c'])->getLibelle() => 'final'); break;
	case 'etudiant': $filArianne = array('My Study Companion' => 'index.php', $daoEtudiant->getByID($_GET['e'])->getPrenom() . ' ' . $daoEtudiant->getByID($_GET['e'])->getNom()  => 'final'); break;
	
}
include_once ('../vue/index.php');