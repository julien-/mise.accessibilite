<?php
if((isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser'])) && (isset($_SESSION['cours']) && !empty($_SESSION['cours'])))
{
	if (isset($_SESSION['bonusAdded']))
	{
		unset($_SESSION['bonusAdded']);
		$bonusAdded = true;
	}
	else
	{
		$bonusAdded = false;
	}
	include_once('../vue/mes_bonus.php');
}
else
	include_once('../vue/introuvable.php');
?>