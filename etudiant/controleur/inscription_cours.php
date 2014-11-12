<?php
if(isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser']))
{
	$listeAllCours = $daoCours->getAll();
	include_once('../vue/inscription_cours.php');
}
else
	include_once('../vue/introuvable.php');
?>