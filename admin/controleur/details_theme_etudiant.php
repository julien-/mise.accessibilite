<?php 
$daoTheme = new DAOTheme($db);
$daoEtudiant = new DAOEtudiant($db);
$etudiant = $daoEtudiant->getByID($_GET['e']);
$theme = $daoTheme->getByID($_GET['t']);
$progression = $daoAvancement->getByThemeEtudiant($theme->getId (), $etudiant->getId());
include_once('../vue/details_theme_etudiant.php');
?>