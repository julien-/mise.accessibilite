<?php
$listeThemes = $daoTheme->getAllByCours($_SESSION["cours"]->getId());
include_once('../Vue/mes_bonus.php');
?>