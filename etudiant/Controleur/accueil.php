<?php
$nbCours = $daoInscription->countByEtudiant($_SESSION['currentUser']->getId());
include_once('../Vue/accueil.php');
?>