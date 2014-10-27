<?php 
$daoTheme = new DAOTheme($db);
$theme = $daoTheme->getByID($_GET['t']);

include('../vue/details_theme.php');
?>