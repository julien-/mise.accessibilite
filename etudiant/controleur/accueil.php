<?php
if(isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser']))
{
	if (isset($_SESSION['avatarAdd']))
	{
		unset($_SESSION['avatarAdd']);
		$avatarAdd = true;
	}
	else
	{
		$avatarAdd = false;
	}
	
	if (isset($_SESSION['fichierVide']))
	{
		unset($_SESSION['fichierVide']);
		$fichierVide = true;
	}
	else
	{
		$fichierVide = false;
	}
	
	if (isset($_SESSION['nomFichierInvalide']))
	{
		unset($_SESSION['nomFichierInvalide']);
		$nomFichierInvalide = true;
	}
	else
	{
		$nomFichierInvalide = false;
	}
	
	if (isset($_SESSION['typeFichierInvalide']))
	{
		unset($_SESSION['typeFichierInvalide']);
		$typeFichierInvalide = true;
	}
	else
	{
		$typeFichierInvalide = false;
	}
	include_once('../vue/accueil.php');
}
else 
	include_once('../vue/introuvable.php');
?>