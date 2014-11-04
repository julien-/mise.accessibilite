<?php 
$daoTheme = new DAOTheme($db);
$daoExercice = new DAOExercice($db);
$daoCours = new DAOCours($db);
$daoFichiers = new DAOFichier($db);

if (isset($_GET['c']))
	$_SESSION['cours'] = $daoCours->getByID($_GET['c']);


$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());
$cours = $_SESSION['cours'];

include_once('../vue/gestion_cours.php');
?>