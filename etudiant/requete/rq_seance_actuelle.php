<?php
include_once ('../../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$daoRemarque= new DAORemarque($db);
$daoAvancement= new DAOAvancement($db);

if (isset($_GET["addremarque"])) {
	$daoRemarque->saveByIdSeanceIdEtudiantRemarque($_POST['id_seance'], $_SESSION['currentUser']->getId(), $_POST['remarque']);
	$_SESSION['remarqueAdded'] = 'true';
}

if (isset($_GET["modifyremarque"])) {
	$daoRemarque->updateRemarqueByIdSeanceIdEtudiant($_POST['id_seance'], $_SESSION['currentUser']->getId(), $_POST['remarque']);
	$_SESSION['remarqueModified'] = 'true';
}

if (isset($_GET["maj_avancement"])) {
	if(isset($_POST['fait']))
	{		
		foreach($_POST['fait'] as $id_exo)
		{
			$daoAvancement->insertFaitByExerciceEtudiantSeance($id_exo, $_SESSION['currentUser']->getId(), $_POST['id_seance']);
		}
	}
	
	if(isset($_POST['compris']))
	{
		foreach($_POST['compris'] as $id_exo)
		{
			$daoAvancement->insertComprisByExerciceEtudiantSeance($id_exo, $_SESSION['currentUser']->getId(), $_POST['id_seance']);
		}
	}
	
	if(isset($_POST['assimile']))
	{
		foreach($_POST['assimile'] as $id_exo)
		{
			$daoAvancement->insertAssimileByExerciceEtudiantSeance($id_exo, $_SESSION['currentUser']->getId(), $_POST['id_seance']);
		}
	}
	$_SESSION['avancementModified'] = 'true';
}

// on le redirige vers la page d'où il venait avec la notification que y a eu erreur ou pas
header('Location: ' . $_SESSION['referrer']);
?>