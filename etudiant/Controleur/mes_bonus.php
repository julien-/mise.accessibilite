<?php
$listeThemes = $daoTheme->getAllByCours($_SESSION['cours']->getId());
$listeInscrits = $daoInscription->getAllByCoursExceptEtu($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());
include_once('../Vue/mes_bonus.php');
?>