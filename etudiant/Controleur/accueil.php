<?php
$nbCours = $daoInscription->countByEtudiant($_SESSION['currentUser']->getId());
$nbMessagesNnLu = $daoMessage->countNbNonLu($_SESSION['currentUser']->getId());
include_once('../Vue/accueil.php');
?>