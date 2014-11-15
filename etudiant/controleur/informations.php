<?php
if((isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser'])) && (isset($_SESSION['cours']) && !empty($_SESSION['cours'])))
{
	if (isset($_SESSION['themeAdded']))
	{
		unset($_SESSION['themeAdded']);
		$themeAdded = true;
	}
	else
	{
		$themeAdded = false;
	}
	include_once('../vue/informations.php');
}
else 
	include_once('../vue/introuvable.php');
	
?>