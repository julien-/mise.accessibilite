<?php
if((isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser'])) && (isset($_SESSION['cours']) && !empty($_SESSION['cours'])))
{
	if (isset($_SESSION['remarqueAdded']))
	{
		unset($_SESSION['remarqueAdded']);
		$remarqueAdded = true;
	}
	else
	{
		$remarqueAdded = false;
	}
	
	if (isset($_SESSION['noteAdded']))
	{
		unset($_SESSION['noteAdded']);
		$noteAdded = true;
	}
	else
	{
		$noteAdded = false;
	}
	
	if (isset($_SESSION['suiviAdded']))
	{
		unset($_SESSION['suiviAdded']);
		$suiviAdded = true;
	}
	else
	{
		$suiviAdded = false;
	}
	
	include_once('../vue/autres_bonus.php');
}
else
	include_once('../vue/introuvable.php');
?>