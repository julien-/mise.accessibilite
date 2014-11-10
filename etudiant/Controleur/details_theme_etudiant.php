<?php 
$theme = $daoTheme->getByID($_GET['id_theme']);
$progression_theme = $daoAvancement->getByThemeEtudiant($theme->getId (), $_SESSION['currentUser']->getId());
include_once('../Vue/details_theme_etudiant.php');
?>