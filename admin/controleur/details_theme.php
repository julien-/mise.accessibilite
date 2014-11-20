<?php 
$daoTheme = new DAOTheme($db);
$daoExos = new DAOExercice($db);
$daoInscription = new DAOInscription($db);

$theme = $daoTheme->getByID($_GET['t']);
$listeEtudiants = $daoInscription->getAllByCours($theme->getCours()->getId());
$daoAvanc = new DAOAvancement($db);

$listeExos = $daoExos->getByAllByTheme($_GET['t']);
include('../vue/details_theme.php');
?>