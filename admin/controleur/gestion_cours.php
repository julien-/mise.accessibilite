<?php 
$daoTheme = new DAOTheme($db);
$daoExercice = new DAOExercice($db);
$daoCours = new DAOCours($db);
$daoFichiers = new DAOFichier($db);

if (isset($_GET['c']))
	$_SESSION['cours'] = $daoCours->getByID($_GET['c']);

if (isset($_POST['titre-exo']))
{	
	$exercice = $daoExercice->getByID($_POST['id-exo']);
	$exercice = $exercice->setTitre($_POST['titre-exo']);
	$daoExercice->update($exercice);
}

$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());
$cours = $_SESSION['cours'];

include_once('../vue/gestion_cours.php');
?>