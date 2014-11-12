<?php
if(isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser']))
{
	$nbCours = $daoInscription->countByEtudiant($_SESSION['currentUser']->getId());
	include_once('../vue/accueil.php');
}
else 
	include_once('../vue/introuvable.php');
?>