<?php 
if((isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser'])) && (isset($_SESSION['cours']) && !empty($_SESSION['cours'])) && (isset($_GET['id_theme']) && !empty($_GET['id_theme'])))
{
	$theme = $daoTheme->getByID($_GET['id_theme']);
	$progression_theme = $daoAvancement->getByThemeEtudiant($theme->getId (), $_SESSION['currentUser']->getId());
	include_once('../vue/details_theme_etudiant.php');
}
else 
	include_once('../vue/introuvable.php');
?>