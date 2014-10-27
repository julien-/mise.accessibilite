<?php 
$daoTheme = new DAOTheme($db);
$daoExercice = new DAOExercice($db);
$daoCours = new DAOCours($db);
$daoFichiers = new DAOFichier($db);

$listeThemes = $daoTheme->getAllByCours($_GET['c']);
$cours = $daoCours->getByID($_GET['c']);

include_once('../vue/gestion_cours.php');
?>