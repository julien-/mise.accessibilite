<?php
if(isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser']))
{
	if (isset($_SESSION['inscriptionAdded']))
	{
		unset($_SESSION['inscriptionAdded']);
		$inscriptionAdded = true;
	}
	else
	{
		$inscriptionAdded = false;
	}
	$listeAllCours = $daoCours->getAll();
	include_once('../vue/inscription_cours.php');
}
else
	include_once('../vue/introuvable.php');
?>