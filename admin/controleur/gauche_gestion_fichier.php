<?php 
$daoTheme = new DAOTheme($db);
$daoExercice = new DAOExercice($db);

$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());


include_once('../vue/gauche_gestion_fichier.php');
?>