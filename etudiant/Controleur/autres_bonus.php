<?php
$listeThemes = $daoTheme->getAllByCours($_SESSION["cours"]->getId());
include_once('../Vue/autres_bonus.php');
?>