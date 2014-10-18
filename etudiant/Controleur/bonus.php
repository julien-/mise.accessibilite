<?php
$listeThemes = $daoTheme->getAllByCours($_SESSION["cours"]->getId());
include_once('../Vue/bonus.php');
?>